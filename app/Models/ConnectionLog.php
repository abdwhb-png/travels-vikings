<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConnectionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ip_address',
        'country',
        'city',
    ];

    public function connectionLogs()
    {
        return $this->hasMany(ConnectionLog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
