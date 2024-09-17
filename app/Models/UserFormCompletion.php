<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFormCompletion extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_experience_completed',
        'is_reference_completed',
        'user_id',
    ];

}
