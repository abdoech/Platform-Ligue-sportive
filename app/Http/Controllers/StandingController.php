<?php

namespace App\Http\Controllers;

use App\Models\Standing;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StandingController extends Controller
{
    public function index(Request $request): Response
    {
        $season = $request->season ?? date('Y');

        $standings = Standing::with('team')
            ->where('season', $season)
            ->orderBy('position')
            ->get();

        $seasons = Standing::distinct()
            ->whereNotNull('season')
            ->pluck('season')
            ->sort()
            ->values();

        return Inertia::render('Standings/Index', [
            'standings' => $standings,
            'seasons' => $seasons,
            'currentSeason' => $season,
        ]);
    }
}

