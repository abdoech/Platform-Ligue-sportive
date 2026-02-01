<?php

namespace App\Services;

use App\Models\Game;
use App\Models\Standing;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class StandingService
{
    public function updateStandingsForMatch(Game $match, string $season): void
    {
        if (!$match->isFinished()) {
            return;
        }

        $this->updateTeamStanding($match->home_team_id, $season);
        $this->updateTeamStanding($match->away_team_id, $season);
        $this->recalculatePositions($season);
    }

    public function updateTeamStanding(int $teamId, string $season): void
    {
        $team = Team::findOrFail($teamId);
        
        $homeMatches = Game::where('home_team_id', $teamId)
            ->where('season', $season)
            ->where('status', 'finished')
            ->get();

        $awayMatches = Game::where('away_team_id', $teamId)
            ->where('season', $season)
            ->where('status', 'finished')
            ->get();

        $played = $homeMatches->count() + $awayMatches->count();
        $won = 0;
        $drawn = 0;
        $lost = 0;
        $goalsFor = 0;
        $goalsAgainst = 0;

        foreach ($homeMatches as $match) {
            if ($match->home_score > $match->away_score) {
                $won++;
            } elseif ($match->home_score === $match->away_score) {
                $drawn++;
            } else {
                $lost++;
            }
            $goalsFor += $match->home_score ?? 0;
            $goalsAgainst += $match->away_score ?? 0;
        }

        foreach ($awayMatches as $match) {
            if ($match->away_score > $match->home_score) {
                $won++;
            } elseif ($match->away_score === $match->home_score) {
                $drawn++;
            } else {
                $lost++;
            }
            $goalsFor += $match->away_score ?? 0;
            $goalsAgainst += $match->home_score ?? 0;
        }

        $standing = Standing::firstOrCreate(
            ['team_id' => $teamId, 'season' => $season],
            [
                'played' => 0,
                'won' => 0,
                'drawn' => 0,
                'lost' => 0,
                'goals_for' => 0,
                'goals_against' => 0,
                'goal_difference' => 0,
                'points' => 0,
            ]
        );

        $standing->played = $played;
        $standing->won = $won;
        $standing->drawn = $drawn;
        $standing->lost = $lost;
        $standing->goals_for = $goalsFor;
        $standing->goals_against = $goalsAgainst;
        $standing->calculateGoalDifference();
        $standing->calculatePoints();
        $standing->save();
    }

    public function recalculatePositions(string $season): void
    {
        $standings = Standing::where('season', $season)
            ->orderByDesc('points')
            ->orderByDesc('goal_difference')
            ->orderByDesc('goals_for')
            ->get();

        $position = 1;
        foreach ($standings as $standing) {
            $standing->position = $position++;
            $standing->save();
        }
    }

    public function recalculateAllStandings(string $season): void
    {
        $teams = Team::all();
        
        foreach ($teams as $team) {
            $this->updateTeamStanding($team->id, $season);
        }
        
        $this->recalculatePositions($season);
    }
}

