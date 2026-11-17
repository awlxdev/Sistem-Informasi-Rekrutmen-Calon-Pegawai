<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'captcha_answer' => ['required', 'string', 'max:100'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'captcha_answer.required' => 'Konfirmasi CAPTCHA wajib diisi.',
        ]);

        $expected = $request->session()->get('captcha_answer');

        if (
            !$expected ||
            mb_strtolower(trim($validated['captcha_answer'])) !==
            mb_strtolower(trim($expected))
        ) {
            throw ValidationException::withMessages([
                'captcha_answer' => 'Jawaban CAPTCHA tidak benar.',
            ]);
        }

        $user = DB::transaction(function () use ($validated): User {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => User::ROLE_PELAMAR,
                'is_active' => true,
            ]);

            Applicant::create([
                'user_id' => $user->id,
                'full_name' => $validated['name'],
            ]);

            return $user;
        });

        $request->session()->forget('captcha_answer');

        Auth::login($user);
        $request->session()->regenerate();

        event(new Registered($user));

        return redirect()->route('verification.notice')
            ->with('success', 'Pendaftaran berhasil. Silakan verifikasi email Anda.');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'captcha_answer' => ['required', 'string'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'captcha_answer.required' => 'Konfirmasi CAPTCHA wajib diisi.',
        ]);

        $expected = $request->session()->get('captcha_answer');

        if (
            !$expected ||
            mb_strtolower(trim($credentials['captcha_answer'])) !==
            mb_strtolower(trim($expected))
        ) {
            throw ValidationException::withMessages([
                'captcha_answer' => 'Jawaban CAPTCHA tidak benar.',
            ]);
        }

        $authenticated = Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'is_active' => true,
        ], $request->boolean('remember'));

        $request->session()->forget('captcha_answer');

        if (!$authenticated) {
            throw ValidationException::withMessages([
                'email' => 'Email atau password salah, atau akun tidak aktif.',
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if (!$user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice')
                ->with('warning', 'Email belum diverifikasi. Periksa kotak masuk email Anda.');
        }

        return match ($user->role) {
            User::ROLE_ADMIN => redirect()->route('admin.dashboard'),
            User::ROLE_HRD => redirect()->route('hrd.dashboard'),
            User::ROLE_PELAMAR => redirect()->route('pelamar.dashboard'),
            default => $this->rejectUnknownRole($request),
        };
    }

    /**
     * Menolak akun dengan role yang tidak dikenali.
     */
    private function rejectUnknownRole(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->withErrors([
                'email' => 'Role akun tidak dikenali. Silakan hubungi administrator.',
            ]);
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Anda berhasil logout.');
    }
}
