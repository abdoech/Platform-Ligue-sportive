<?php

use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\StandingController;
use App\Http\Controllers\TeamController;
use App\Models\Game;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::bind('match', fn (string $value) => Game::findOrFail($value));

Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/standings', [PublicController::class, 'standings'])->name('public.standings');
Route::get('/teams', [PublicController::class, 'teams'])->name('public.teams');
Route::get('/teams/{team}', [PublicController::class, 'team'])->name('public.team');
Route::get('/matches', [PublicController::class, 'matches'])->name('public.matches');
Route::get('/matches/{match}', [PublicController::class, 'match'])->name('public.match');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            'teamsCount' => Team::count(),
            'playersCount' => Player::count(),
            'matchesCount' => Game::count(),
        ]);
    })->name('admin.dashboard');

    Route::resource('teams', TeamController::class);

    Route::get('/players/create', [PlayerController::class, 'create'])->name('players.create');
    Route::resource('players', PlayerController::class)->except(['create']);

    Route::get('/matches/calendar', [MatchController::class, 'calendar'])->name('matches.calendar');
    Route::post('/matches/{match}/score', [MatchController::class, 'updateScore'])->name('matches.update-score');
    Route::get('/matches/create', [MatchController::class, 'create'])->name('matches.create');
    Route::resource('matches', MatchController::class)->except(['create']);

    Route::get('/standings', [StandingController::class, 'index'])->name('standings.index');
});

require __DIR__.'/auth.php';

