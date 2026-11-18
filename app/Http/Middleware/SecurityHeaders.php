<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Vite;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        Vite::useCspNonce();
        $response = $next($request);
        $nonce = Vite::cspNonce();

        // Mencegah browser menebak tipe konten.
        $response->headers->set(
            'X-Content-Type-Options',
            'nosniff'
        );

        // Membatasi halaman agar tidak dapat ditampilkan
        // dalam frame dari domain lain.
        $response->headers->set(
            'X-Frame-Options',
            'SAMEORIGIN'
        );

        // Mengatur informasi referrer yang dikirim browser.
        $response->headers->set(
            'Referrer-Policy',
            'strict-origin-when-cross-origin'
        );

        // CSP tahap pengujian: hanya melaporkan pelanggaran,
        // belum memblokir resource apa pun.
        $csp = [
            "default-src 'self'",
            "base-uri 'self'",
            "object-src 'none'",
            "frame-ancestors 'self'",
            "form-action 'self'",

            "script-src 'self' 'nonce-".$nonce."' https://hcaptcha.com https://*.hcaptcha.com",
            "style-src 'self' 'nonce-".$nonce."' https://fonts.googleapis.com https://hcaptcha.com https://*.hcaptcha.com",
            "font-src 'self' data: https://fonts.gstatic.com https://hcaptcha.com https://*.hcaptcha.com",
            "img-src 'self' data: blob: https://hcaptcha.com https://*.hcaptcha.com",
            "connect-src 'self' https://hcaptcha.com https://*.hcaptcha.com",
            "frame-src 'self' https://hcaptcha.com https://*.hcaptcha.com",
            "media-src 'self' blob:",
            "manifest-src 'self'",
        ];

        $response->headers->set(
            'Content-Security-Policy-Report-Only',
            implode('; ', $csp)
        );

        // HSTS hanya dikirim pada production melalui HTTPS.
        if (app()->environment('production') && $request->isSecure()) {
            $response->headers->set(
                'Strict-Transport-Security',
                'max-age=31536000'
            );
        }

        return $response;
    }
}
