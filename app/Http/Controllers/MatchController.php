<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use App\Services\StandingService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MatchController extends Controller
{
    public function __construct(
        private StandingService $standingService
    ) {}

    public function index(Request $request): Response
    {
        $query = Game::with(['homeTeam', 'awayTeam']);

        if ($request->has('season')) {
            $query->where('season', $request->season);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $matches = $query->orderBy('match_date', 'desc')
            ->paginate(20)
            ->withQueryString();

        $seasons = Game::distinct()
            ->whereNotNull('season')
            ->pluck('season')
            ->sort()
            ->values();

        return Inertia::render('Matches/Index', [
            'matches' => $matches,
            'seasons' => $seasons,
            'filters' => $request->only(['season', 'status']),
        ]);
    }

    public function calendar(Request $request): Response
    {
        $query = Game::with(['homeTeam', 'awayTeam']);

        if ($request->has('month')) {
            $month = $request->month;
            $query->whereMonth('match_date', date('m', strtotime($month)))
                ->whereYear('match_date', date('Y', strtotime($month)));
        } else {
            $query->whereMonth('match_date', now()->month)
                ->whereYear('match_date', now()->year);
        }

        $matches = $query->orderBy('match_date')
            ->get()
            ->groupBy(function ($match) {
                return $match->match_date->format('Y-m-d');
            });

        return Inertia::render('Matches/Calendar', [
            'matches' => $matches,
            'currentMonth' => $request->month ?? now()->format('Y-m'),
        ]);
    }

    public function show(Game $match): Response
    {
        $match->load(['homeTeam', 'awayTeam', 'events.player']);

        return Inertia::render('Matches/Show', [
            'match' => $match,
        ]);
    }

    public function edit(Game $match): Response
    {
        $teams = Team::orderBy('name')->get();
        $seasons = Game::distinct()
            ->whereNotNull('season')
            ->pluck('season')
            ->sort()
            ->values();

        return Inertia::render('Matches/Edit', [
            'match' => $match,
            'teams' => $teams,
            'seasons' => $seasons,
        ]);
    }

    public function create(): Response
    {
        $teams = Team::orderBy('name')->get();
        $seasons = Game::distinct()
            ->whereNotNull('season')
            ->pluck('season')
            ->sort()
            ->values();

        return Inertia::render('Matches/Create', [
            'teams' => $teams,
            'seasons' => $seasons,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'home_team_id' => 'required|exists:teams,id|different:away_team_id',
            'away_team_id' => 'required|exists:teams,id|different:home_team_id',
            'match_date' => 'required|date|after:now',
            'venue' => 'nullable|string|max:255',
            'round' => 'nullable|integer|min:1',
            'season' => 'nullable|string|max:255',
        ]);

        $match = Game::create($validated);

        return redirect()->to('/admin/matches/' . $match->id)
            ->with('success', 'Match créé avec succès.');
    }

    public function updateScore(Request $request, Game $match)
    {
        $validated = $request->validate([
            'home_score' => 'required|integer|min:0',
            'away_score' => 'required|integer|min:0',
            'status' => 'required|in:finished,live',
        ]);

        $match->update($validated);

        if ($match->status === 'finished' && $match->season) {
            $this->standingService->updateStandingsForMatch($match, $match->season);
        }

        return redirect()->back()
            ->with('success', 'Score mis à jour avec succès.');
    }

    public function update(Request $request, Game $match)
    {
        $validated = $request->validate([
            'home_team_id' => 'required|exists:teams,id|different:away_team_id',
            'away_team_id' => 'required|exists:teams,id|different:home_team_id',
            'match_date' => 'required|date',
            'venue' => 'nullable|string|max:255',
            'status' => 'required|in:scheduled,live,finished,postponed,cancelled',
            'round' => 'nullable|integer|min:1',
            'season' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $match->update($validated);

        return redirect()->to('/admin/matches/' . $match->id)
            ->with('success', 'Match mis à jour avec succès.');
    }
}

