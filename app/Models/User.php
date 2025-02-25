<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\OCms\Enums\UserRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
        ];
    }

    /**
     * Actions à effectuer à la création et à la mise à jour d'un post
     */
    protected static function booted(): void
    {

        static::updating(function (self $user) {
            /**
             * Mise à jour de la session de l'utilisateur s'il s'agit d'une mise à jour de l'utilisateur connecté afin d'éviter
             * la déconnexion car des infos ont changé
             */
            $authUser = auth()->user();
            if ($authUser->id === $user->id) {
                session()->put([
                    'password_hash_web' => $user->password,
                ]);
            }
        });
    }

    /**
     * Vérifie si l'utilisateur a accès au panneau d'admin
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === UserRoles::Admin->value && $this->hasVerifiedEmail();
    }
}
