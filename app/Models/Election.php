<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'is_active', 'type'];

    public function vote_counts()
    {
        return $this->hasMany(ElectionResult::class);
    }
}
