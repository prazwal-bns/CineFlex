<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Enums\OrganizationType;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements HasAvatar
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'organization',
        'address',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'organization' => OrganizationType::class,
        ];
    }

    public function getFilamentAvatarUrl(): string
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : asset('storage/avatar.jpg');
    }


    public function theaters()
    {
        return $this->hasMany(Theater::class, 'manager_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isSuperAdmin(): bool
    {
        return $this->roles->contains('name', 'super_admin');
    }

    public function isTheaterManager(): bool
    {
        return $this->roles->contains('name', 'theater_manager');
    }


    public function isCustomer(): bool
    {
        return $this->roles->contains('name', 'customer');
    }

    public static function getTheaterManagers()
    {
        return self::whereHas('roles', function ($query) {
            $query->where('name', 'theater_manager');
        })->pluck('name', 'id');
    }
}
