<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 'role',
    ];

    public function role()
    {
        return $this->role; // Giả sử bạn lưu vai trò trong trường 'role'
    }

    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class);
    }

    // Mối quan hệ một-nhiều với bảng blogs

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


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
}
