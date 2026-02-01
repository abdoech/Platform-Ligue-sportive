<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TeamController extends Controller
{
    public function index(): Response
    {
        $teams = Team::withCount('players')
            ->orderBy('name')
            ->get();

        return Inertia::render('Teams/Index', [
            'teams' => $teams,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Teams/Create');
    }

    public function show(Team $team): Response
    {
        $team->load(['players', 'standings', 'homeMatches', 'awayMatches']);

        return Inertia::render('Teams/Show', [
            'team' => $team,
        ]);
    }

    public function edit(Team $team): Response
    {
        return Inertia::render('Teams/Edit', [
            'team' => $team,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'stadium' => 'nullable|string|max:255',
            'founded_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'description' => 'nullable|string',
        ]);

        $team = Team::create($validated);

        return redirect()->to('/admin/teams/' . $team->slug)
            ->with('success', 'Équipe créée avec succès.');
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'stadium' => 'nullable|string|max:255',
            'founded_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'description' => 'nullable|string',
        ]);

        $team->update($validated);

        return redirect()->to('/admin/teams/' . $team->slug)
            ->with('success', 'Équipe mise à jour avec succès.');
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->to('/admin/teams')
            ->with('success', 'Équipe supprimée avec succès.');
    }
}

