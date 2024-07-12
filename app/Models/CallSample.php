<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallSample extends Model
{
    use HasFactory;

    protected $fillable = [
        'inbound_call',
        'outbound_call',
        'user_id',
    ];

    public function user() {
        $this->belongsTo(User::class);
    }
}

