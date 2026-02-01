@extends('layouts.public')

@section('title', $team->name)

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0 h-20 w-20 bg-gray-300 rounded-full flex items-center justify-center">
                    <span class="text-gray-600 font-bold text-2xl">{{ $team->name[0] }}</span>
                </div>
                <div class="ml-4">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $team->name }}</h1>
                    @if($team->city)
                        <p class="text-lg text-gray-600">{{ $team->city }}</p>
                    @endif
                </div>
            </div>
            @if($team->description)
                <p class="text-gray-700 mb-4">{{ $team->description }}</p>
            @endif
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                @if($team->stadium)
                    <div>
                        <span class="font-medium">Stade:</span> {{ $team->stadium }}
                    </div>
                @endif
                @if($team->founded_year)
                    <div>
                        <span class="font-medium">Fondé en:</span> {{ $team->founded_year }}
                    </div>
                @endif
                <div>
                    <span class="font-medium">Joueurs:</span> {{ $team->players->count() }}
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4">Joueurs</h2>
                @if($team->players->count() > 0)
                    <ul class="divide-y divide-gray-200">
                        @foreach($team->players->where('is_active', true) as $player)
                            <li class="py-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-medium">{{ $player->full_name }}</div>
                                        <div class="text-sm text-gray-500">
                                            @if($player->position)
                                                {{ $player->position }}
                                            @endif
                                            @if($player->position && $player->age)
                                                ·
                                            @endif
                                            @if($player->age)
                                                Âge: {{ $player->age }} ans
                                            @endif
                                        </div>
                                    </div>
                                    @if($player->jersey_number)
                                        <span class="text-sm font-medium text-gray-900">#{{ $player->jersey_number }}</span>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">Aucun joueur enregistré</p>
                @endif
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4">Statistiques</h2>
                @if($team->standings->count() > 0)
                    <div class="space-y-2">
                        @foreach($team->standings as $standing)
                            <div class="border-b border-gray-200 pb-2 mb-2">
                                <div class="font-medium">Saison {{ $standing->season }}</div>
                                <div class="text-sm text-gray-600">
                                    Position: {{ $standing->position ?? 'N/A' }} | 
                                    Points: {{ $standing->points }} | 
                                    Matchs: {{ $standing->played }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Aucune statistique disponible</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

