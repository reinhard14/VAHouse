<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Employment;
use App\Models\Role;
use App\Models\Skillset;
use App\Models\Review;
use App\Models\Status;
use App\Models\Tier;
use App\Models\ApplicantInformation;
use App\Models\CallSample;
use App\Models\Reference;
use App\Models\UserFormCompletion;



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
        'middlename',
        'suffix',
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

    public function reviews()
    {
        return $this->hasMany(Review::class);
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

    public function mockcalls() {
        return $this->hasOne(CallSample::class);
    }

    public function references() {
        return $this->hasOne(Reference::class);
    }

    public function formCompleted() {
        return $this->hasOne(UserFormCompletion::class);
    }

    public function employment() {
        return $this->hasMany(Employment::class);
    }
}
