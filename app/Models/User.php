<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'system_role_id',
        'username',
        'email',
        'email_verified_at',
        'password',
        'remember_token'
    ];

    protected function role()
    {
        return $this->belongsTo(SystemRole::class, 'system_role_id');
    }

    public function member()
    {
        return $this->hasOne(Member::class);
    }

    public function connectionLogs()
    {
        return $this->hasMany(ConnectionLog::class);
    }
}
