<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'state', // national or city corporation election
        'city',
        'nid',
        'mobile',
        'age',
        'dob',
        'gender',
        'religion',
        'is_married',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function vision()
    {
        return $this->hasOne(Vision::class);
    }

    public function party_candidates()
    {
        return $this->hasMany(PartyCandidate::class, 'party_id', 'id');
    }

    public function party()
    {
        return $this->belongsTo(User::class, 'party_id', 'id');
    }

    public function get_party($party_id)
    {
        return User::where('role', 'party')->where('id', $party_id)->first();
    }
}
