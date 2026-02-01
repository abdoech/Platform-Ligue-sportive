<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Standing;
use App\Models\Team;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function index(): View
    {
        try {
            $upcomingMatches = Game::with(['homeTeam', 'awayTeam'])
                ->where('status', 'scheduled')
                ->where('match_date', '>=', now())
                ->orderBy('match_date')
                ->limit(5)
                ->get();

            $recentMatches = Game::with(['homeTeam', 'awayTeam'])
                ->where('status', 'finished')
                ->orderBy('match_date', 'desc')
                ->limit(5)
                ->get();

            $currentSeason = date('Y');
            $standings = Standing::with('team')
                ->where('season', $currentSeason)
                ->orderBy('position')
                ->limit(10)
                ->get();
        } catch (QueryException $e) {
            $upcomingMatches = new Collection;
            $recentMatches = new Collection;
            $standings = new Collection;
        }

        return view('public.index', [
            'upcomingMatches' => $upcomingMatches,
            'recentMatches' => $recentMatches,
            'standings' => $standings,
        ]);
    }

    public function standings(Request $request): View
    {
        $season = $request->season ?? date('Y');

        try {
            $standings = Standing::with('team')
                ->where('season', $season)
                ->orderBy('position')
                ->get();

            $seasons = Standing::distinct()
                ->whereNotNull('season')
                ->pluck('season')
                ->sort()
                ->values();
        } catch (QueryException $e) {
            $standings = new Collection;
            $seasons = new Collection;
        }

        return view('public.standings', [
            'standings' => $standings,
            'seasons' => $seasons,
            'currentSeason' => $season,
        ]);
    }

    public function teams(): View
    {
        try {
            $teams = Team::withCount('players')
                ->orderBy('name')
                ->get();
        } catch (QueryException $e) {
            $teams = new Collection;
        }

        return view('public.teams', [
            'teams' => $teams,
        ]);
    }

    public function team(Team $team): View
    {
        $team->load(['players', 'standings', 'homeMatches', 'awayMatches']);

        return view('public.team', [
            'team' => $team,
        ]);
    }

    public function matches(Request $request): View
    {
        try {
            $query = Game::with(['homeTeam', 'awayTeam']);

            if ($request->has('season')) {
                $query->where('season', $request->season);
            }

            $matches = $query->orderBy('match_date', 'desc')
                ->paginate(20);

            $seasons = Game::distinct()
                ->whereNotNull('season')
                ->pluck('season')
                ->sort()
                ->values();
        } catch (QueryException $e) {
            $matches = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 20);
            $seasons = new Collection;
        }

        return view('public.matches', [
            'matches' => $matches,
            'seasons' => $seasons,
        ]);
    }

    public function match(Game $match): View
    {
        $match->load(['homeTeam', 'awayTeam', 'events.player']);

        return view('public.match', [
            'match' => $match,
        ]);
    }
}

