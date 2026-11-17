<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends VerifyEmail
{
    public function toMail($notifiable): MailMessage
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(
                config('auth.verification.expire', 60)
            ),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        return (new MailMessage)
            ->subject('Verifikasi Alamat Email - Pendaftaran Calon Pegawai')
            ->greeting('Halo, ' . $notifiable->name . '!')
            ->line('Terima kasih telah melakukan pendaftaran pada Sistem Informasi Pendaftaran Calon Pegawai.')
            ->line('Untuk melanjutkan proses pendaftaran, silakan verifikasi alamat email Anda dengan menekan tombol di bawah ini.')
            ->action('Verifikasi Alamat Email', $verificationUrl)
            ->line('Tautan verifikasi ini hanya berlaku selama 60 menit.')
            ->line('Jika Anda tidak merasa melakukan pendaftaran, silakan abaikan email ini.')
            ->salutation("Hormat kami,\nAdministrator Pendaftaran Calon Pegawai");
    }
}
