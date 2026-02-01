<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'description',
        'city',
        'stadium',
        'founded_year',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($team) {
            if (empty($team->slug)) {
                $team->slug = Str::slug($team->name);
            }
        });
    }

    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }

    public function homeMatches(): HasMany
    {
        return $this->hasMany(Game::class, 'home_team_id');
    }

    public function awayMatches(): HasMany
    {
        return $this->hasMany(Game::class, 'away_team_id');
    }

    public function matches(): HasMany
    {
        return $this->hasMany(Game::class, 'home_team_id')
            ->orWhere('away_team_id', $this->id);
    }

    public function standings(): HasMany
    {
        return $this->hasMany(Standing::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
