<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Skillset extends Model
{
    use HasFactory;

    protected $fillable = [
        'website',
        'tool',
        'skill',
        'softskill',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
