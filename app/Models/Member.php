<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parent_id',
        'balance',
        'phone',
        'total_commission',
        'completed_tasks',
        'commission_ratio1',
        'commission_ratio2',
        'min_balance',
        'min_withdrawal',
        'max_withdrawal',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function refferal()
    {
        return $this->hasOne(Refferal::class);
    }
 
    public function tasks()
        {
            return $this->hasMany(Task::class);
        }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function commissionRatio()
    {
        return $this->hasOne(CommissionRatio::class);
    }

    public function fundInfo()
    {
        return $this->hasOne(FundInfo::class);
    }
}
