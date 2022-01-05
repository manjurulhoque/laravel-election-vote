<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartyCandidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'party_id',
        'candidate_id',
        'status',
        'candidate_name',
        'mother_name',
        'father_name',
        'mobile',
        'description',
        'village',
        'post_office',
        'upazilla',
        'district',
    ];

    public function party()
    {
        return $this->belongsTo(User::class, 'party_id', 'id');
    }

    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidate_id', 'id');
    }
}
