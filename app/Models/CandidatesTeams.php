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
    ];

    /**
     * Get the event (election) that owns the candidates team.
     */
    public function election()
{
    return $this->belongsTo(Election::class, 'events_id');
}

}
