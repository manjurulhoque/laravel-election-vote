<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionResult extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'candidate_id', 'election_id', 'party_id'];

    public function voter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }

    public function party()
    {
        return $this->belongsTo(User::class, 'party_id');
    }
}
