<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    use HasFactory;

    public function administrator ()
    {
        return $this->hasOne(Administrator::class);
    }

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
