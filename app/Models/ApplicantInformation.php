<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class ApplicantInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate',
        'portfolio',
        'videolink',
        'experience',
        'skype',
        'resume',
        'niche',
        'ub_account',
        'ub_number',
        'photo_id',
        'photo_formal',
        'disc_results',
        'positions',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
