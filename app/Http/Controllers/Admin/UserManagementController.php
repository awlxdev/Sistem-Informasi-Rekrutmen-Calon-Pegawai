<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->latest();

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            $query->where(
                'is_active',
                $request->status === 'active'
            );
        }

        $users = $query->paginate(10)->withQueryString();

        $statistics = [
            'total' => User::count(),
            'admin' => User::where('role', User::ROLE_ADMIN)->count(),
            'hrd' => User::where('role', User::ROLE_HRD)->count(),
            'pelamar' => User::where('role', User::ROLE_PELAMAR)->count(),
            'inactive' => User::where('is_active', false)->count(),
        ];

        return view('admin.users.index', compact('users', 'statistics'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role' => [
                'required',
                Rule::in([
                    User::ROLE_ADMIN,
                    User::ROLE_HRD,
                    User::ROLE_PELAMAR,
                ]),
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $validated['role'],
                'password' => $validated['password'],
                'is_active' => true,
            ]);

            if ($user->role === User::ROLE_PELAMAR) {
                Applicant::firstOrCreate(
                    ['user_id' => $user->id],
                    ['full_name' => $user->name]
                );
            }

            return $user;
        });

        $user->sendEmailVerificationNotification();

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Akun berhasil dibuat. Permintaan pengiriman tautan verifikasi telah diproses oleh konfigurasi email aplikasi.'
            );
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'role' => [
                'required',
                Rule::in([
                    User::ROLE_ADMIN,
                    User::ROLE_HRD,
                    User::ROLE_PELAMAR,
                ]),
            ],
            'is_active' => ['required', 'boolean'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $currentUser = $request->user();

        if ($user->id === $currentUser->id && (
            $validated['role'] !== $user->role ||
            (bool) $validated['is_active'] !== $user->is_active
        )) {
            return back()->withInput()->withErrors([
                'role' => 'Anda tidak dapat mengubah peran atau status akun sendiri.',
            ]);
        }

        $removingAdmin = $user->role === User::ROLE_ADMIN
            && $user->is_active
            && (
                $validated['role'] !== User::ROLE_ADMIN ||
                ! (bool) $validated['is_active']
            );

        if ($removingAdmin) {
            $activeAdmins = User::where('role', User::ROLE_ADMIN)
                ->where('is_active', true)
                ->count();

            if ($activeAdmins <= 1) {
                return back()->withInput()->withErrors([
                    'role' => 'Administrator aktif terakhir tidak boleh dinonaktifkan atau diturunkan perannya.',
                ]);
            }
        }

        $emailChanged = $user->email !== $validated['email'];

        DB::transaction(function () use ($user, $validated, $emailChanged) {
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->role = $validated['role'];
            $user->is_active = (bool) $validated['is_active'];

            if ($emailChanged) {
                $user->email_verified_at = null;
            }

            if (! empty($validated['password'])) {
                $user->password = $validated['password'];
            }

            $user->save();

            if ($user->role === User::ROLE_PELAMAR) {
                Applicant::firstOrCreate(
                    ['user_id' => $user->id],
                    ['full_name' => $user->name]
                );
            }
        });

        if ($emailChanged) {
            $user->sendEmailVerificationNotification();
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Data akun berhasil diperbarui.');
    }

    public function toggleStatus(User $user)
    {
        $currentUser = request()->user();

        if ($user->id === $currentUser->id) {
            return back()->with(
                'error',
                'Anda tidak dapat menonaktifkan akun sendiri.'
            );
        }

        if (
            $user->role === User::ROLE_ADMIN &&
            $user->is_active
        ) {
            $activeAdmins = User::where('role', User::ROLE_ADMIN)
                ->where('is_active', true)
                ->count();

            if ($activeAdmins <= 1) {
                return back()->with(
                    'error',
                    'Administrator aktif terakhir tidak boleh dinonaktifkan.'
                );
            }
        }

        $user->is_active = ! $user->is_active;
        $user->save();

        return back()->with(
            'success',
            $user->is_active
                ? 'Akun berhasil diaktifkan.'
                : 'Akun berhasil dinonaktifkan.'
        );
    }
}