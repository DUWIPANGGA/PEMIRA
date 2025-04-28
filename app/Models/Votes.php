<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'candidates_team_id',
    ];

    /**
     * Get the user that cast the vote.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    /**
     * Get the candidates team that the vote is for.
     */
    public function candidatesTeam()
    {
        return $this->belongsTo(CandidatesTeam::class, 'candidates_team_id');
    }
}
