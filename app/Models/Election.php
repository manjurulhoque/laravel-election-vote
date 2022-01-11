<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'is_active', 'type', 'is_published', 'winner_id'];

    public function vote_counts()
    {
        return $this->hasMany(ElectionResult::class);
    }

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }

    public function winners()
    {
        return $this->vote_counts()->groupBy('party_id')->selectRaw('count(*) as total, party_id')->get();
    }

    public function winner_party($winners)
    {
        $winners = $winners->sortBy('total');

        $winner = $winners->last();

        return $winner;
    }
}
