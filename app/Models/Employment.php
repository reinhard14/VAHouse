<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    use HasFactory;

    protected $fillable = [
        'employment_type',
        'date_started',
        'date_ended',
        'job_position',
        'company_details',
        'job_details',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
