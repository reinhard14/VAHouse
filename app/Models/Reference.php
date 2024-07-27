<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = [
        'emergency_person',
        'emergency_relationship',
        'emergency_number',
        'start_date',
        'department',
        'team_leader',
        'referral',
        'preferred_shift',
        'work_status',
        'services_offered',
    ];

    protected $casts = [
        'services_offered' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
