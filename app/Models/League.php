<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class League extends Model
{
    use HasFactory;

    protected $table = 'leagues';

    protected $guarded = [];

    protected $fillable = [];

    public function FantasyTeams(): HasMany
    {
        return $this->hasMany(FantasyTeam::class, 'league_id')
            ->with('User');
    }

    public function Franchise(): BelongsTo
    {
        return $this->belongsTo(Franchise::class, 'franchise_id');
    }
}
