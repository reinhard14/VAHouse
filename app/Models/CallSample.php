<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


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

