<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVotes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'election_id',
        'has_voted',
    ];

    protected $casts = [
        'has_voted' => 'boolean',
    ];

    /**
     * Get the user associated with the user vote.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    /**
     * Get the election associated with the user vote.
     */
    public function election()
    {
        return $this->belongsTo(Elections::class, 'id');
    }
}
