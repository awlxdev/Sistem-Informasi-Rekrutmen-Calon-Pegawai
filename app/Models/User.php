<?php

namespace App\Models;

use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, MustVerifyEmailTrait;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_HRD = 'hrd';
    public const ROLE_PELAMAR = 'pelamar';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function applicant(): HasOne
    {
        return $this->hasOne(Applicant::class);
    }

    public function createdVacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class, 'created_by');
    }

    public function reviewedApplications(): HasMany
    {
        return $this->hasMany(Application::class, 'reviewed_by');
    }

    public function verifiedDocuments(): HasMany
    {
        return $this->hasMany(ApplicationDocument::class, 'verified_by');
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isHrd(): bool
    {
        return $this->role === self::ROLE_HRD;
    }

    public function isPelamar(): bool
    {
        return $this->role === self::ROLE_PELAMAR;
    }
public function sendEmailVerificationNotification(): void
{
    $this->notify(new CustomVerifyEmail());
}
}
