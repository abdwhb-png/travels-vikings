<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'duplicated',
        'image_path',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
