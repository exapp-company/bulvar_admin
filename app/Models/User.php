<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRoles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


/**
 * Class User
 * @package App\Models
 *
 * @method static Builder role(string $role)
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'refresh_token',
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
        ];
    }


    public function isAdmin(): bool
    {
        return $this->role === UserRoles::get('admin');
    }


    public function isContent(): bool
    {
        return $this->role === UserRoles::get('content');
    }



    public function isSeo(): bool
    {
        return $this->role === UserRoles::get('seo');
    }



    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims(): array
    {
        return [];
    }


    /**
     * Scope a query to only include users of a given role.
     *
     * @param Builder $query
     * @param string $role
     * @return Builder
     */
    public function scopeRole(Builder $query, string $role): Builder
    {
        return $query->where('role', $role);
    }
}
