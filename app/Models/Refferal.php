<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refferal extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'invit_code',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
