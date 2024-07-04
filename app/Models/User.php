<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Skillset;
use App\Models\Review;
use App\Models\Status;
use App\Models\Tier;
use App\Models\ApplicantInformation;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'contactnumber',
        'email',
        'password',
        'age',
        'gender',
        'education',
        'address',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function information()
    {
        return $this->hasOne(ApplicantInformation::class);
    }

    public function skillsets()
    {
        return $this->hasOne(Skillset::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function status() {
        return $this->hasOne(Status::class);
    }

    public function tier() {
        return $this->hasOne(Tier::class);
    }

    public function experiences() {
        return $this->hasMany(Experience::class);
    }
}
