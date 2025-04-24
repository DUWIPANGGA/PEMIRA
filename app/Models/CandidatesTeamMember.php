<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidatesTeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidates_team_id',
        'user_id',
        'position',
    ];

    /**
     * Get the candidate team thaxt the member belongs to.
     */
    public function candidatesTeam()
    {
        return $this->belongsTo(CandidatesTeam::class, 'candidates_team_id');
    }

    /**
     * Get the user that is the team member.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
