<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function posts() {
        return $this->hasMany('App\Models\Post');
    }

    public function reads() {
        return $this->hasMany('App\Models\Read');
    }

    public function modelSearchUser($keyword) {
        return $this->query()
            ->Where(function($query) use ($keyword) {
                $query->orWhere('name', 'Like', '%'.$keyword.'%')
                    ->orWhere('email', 'Like', '%'.$keyword.'%');
                    })->latest()->paginate(20);
    }

}
