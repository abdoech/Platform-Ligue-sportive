<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use App\Services\StandingService;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $teams = Team::factory(8)->create();

        foreach ($teams as $team) {
            Player::factory(15)->create([
                'team_id' => $team->id,
            ]);
        }

        $season = (string) date('Y');
        $standingService = new StandingService();

        $finishedCount = 0;
        $maxFinished = min(20, (count($teams) * (count($teams) - 1)) / 2);
        for ($i = 0; $i < count($teams) && $finishedCount < $maxFinished; $i++) {
            for ($j = $i + 1; $j < count($teams) && $finishedCount < $maxFinished; $j++) {
                $homeScore = rand(0, 3);
                $awayScore = rand(0, 3);
                Game::create([
                    'home_team_id' => $teams[$i]->id,
                    'away_team_id' => $teams[$j]->id,
                    'match_date' => now()->subDays(rand(1, 60)),
                    'status' => 'finished',
                    'home_score' => $homeScore,
                    'away_score' => $awayScore,
                    'round' => (int) (($finishedCount / count($teams)) + 1),
                    'season' => $season,
                ]);
                $finishedCount++;
            }
        }

        $standingService->recalculateAllStandings($season);

        for ($i = 0; $i < count($teams); $i++) {
            for ($j = $i + 1; $j < count($teams); $j++) {
                if (rand(0, 1)) {
                    continue;
                }
                Game::create([
                    'home_team_id' => $teams[$i]->id,
                    'away_team_id' => $teams[$j]->id,
                    'match_date' => now()->addDays(rand(1, 30)),
                    'status' => 'scheduled',
                    'round' => 1,
                    'season' => $season,
                ]);
            }
        }
    }
}

