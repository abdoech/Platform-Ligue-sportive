<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PlayerController extends Controller
{
    public function index(): Response
    {
        $players = Player::with('team')
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        return Inertia::render('Players/Index', [
            'players' => $players,
        ]);
    }

    public function show(Player $player): Response
    {
        $player->load(['team', 'matchEvents.match']);

        return Inertia::render('Players/Show', [
            'player' => $player,
        ]);
    }

    public function edit(Player $player): Response
    {
        $teams = Team::orderBy('name')->get();

        return Inertia::render('Players/Edit', [
            'player' => $player,
            'teams' => $teams,
        ]);
    }

    public function create(Request $request): Response
    {
        $teams = Team::orderBy('name')->get();
        $teamId = $request->query('team');

        return Inertia::render('Players/Create', [
            'teams' => $teams,
            'teamId' => $teamId ? (int) $teamId : null,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'jersey_number' => 'nullable|integer|min:1|max:99',
            'date_of_birth' => 'nullable|date|before:today',
            'nationality' => 'nullable|string|max:255',
            'height' => 'nullable|integer|min:100|max:250',
            'weight' => 'nullable|integer|min:40|max:150',
        ]);

        $player = Player::create($validated);

        return redirect()->to('/admin/players/' . $player->id)
            ->with('success', 'Joueur créé avec succès.');
    }

    public function update(Request $request, Player $player)
    {
        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'jersey_number' => 'nullable|integer|min:1|max:99',
            'date_of_birth' => 'nullable|date|before:today',
            'nationality' => 'nullable|string|max:255',
            'height' => 'nullable|integer|min:100|max:250',
            'weight' => 'nullable|integer|min:40|max:150',
            'is_active' => 'boolean',
        ]);

        $player->update($validated);

        return redirect()->to('/admin/players/' . $player->id)
            ->with('success', 'Joueur mis à jour avec succès.');
    }

    public function destroy(Player $player)
    {
        $player->delete();

        return redirect()->to('/admin/players')
            ->with('success', 'Joueur supprimé avec succès.');
    }
}

