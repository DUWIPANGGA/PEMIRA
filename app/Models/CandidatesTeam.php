<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidatesTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'events_id',
        'name',
        'slogan',
        'vision',
        'mission',
        'picture'
    ];

    /**
     * Get the event (election) that owns the candidates team.
     */
    public function election()
{
    return $this->belongsTo(Elections::class, 'events_id');
}
public function members()
{
    return $this->hasMany(CandidatesTeamMember::class, 'candidates_team_id');
}

}
