<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EmailVerificationController extends Controller
{
    public function notice()
    {
        $user = Auth::user();

        if (! ($user instanceof User)) {
            return redirect()->route('login');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login');
        }

        return view('auth.verify-email');
    }

    public function verify(Request $request, string $id, string $hash): RedirectResponse
    {
        $user = User::findOrFail($id);

        // Pastikan tautan sesuai dengan akun yang sedang login.
        if (! Auth::check() || (string) Auth::id() !== (string) $user->id) {
            return redirect()->route('login')
                ->with('error', 'Silakan login menggunakan akun yang menerima tautan verifikasi.');
        }

        // Validasi hash email.
        if (! hash_equals(sha1($user->getEmailForVerification()), $hash)) {
            abort(403, 'Tautan verifikasi tidak valid.');
        }

        // Proses verifikasi email.
        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        // Akhiri sesi dan arahkan kembali ke halaman login.
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Email berhasil diverifikasi. Silakan login menggunakan akun Anda.');
    }

    public function resend(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')
                ->with('success', 'Email Anda sudah terverifikasi. Silakan login.');
        }

        $user->sendEmailVerificationNotification();

        return back()->with(
            'success',
            'Tautan verifikasi baru berhasil dikirim. Silakan periksa email Anda.'
        );
    }
}
