<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'website',
        // 'application',
        'tool',
        'skill',
        'softskill',
        'rate',
        'videolink',
        'portfolio',
        'resume',
        'experience',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
