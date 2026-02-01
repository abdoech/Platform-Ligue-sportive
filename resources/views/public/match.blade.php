@extends('layouts.public')

@section('title', 'Match')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <div class="text-center mb-6">
                <div class="flex items-center justify-center space-x-8">
                    <div class="flex-1 text-right">
                        <h2 class="text-2xl font-bold">{{ $match->homeTeam->name }}</h2>
                    </div>
                    <div class="text-center">
                        @if($match->status === 'finished')
                            <div class="text-4xl font-bold">{{ $match->home_score }} - {{ $match->away_score }}</div>
                        @else
                            <div class="text-lg text-gray-500">{{ $match->match_date->format('d/m/Y H:i') }}</div>
                        @endif
                    </div>
                    <div class="flex-1 text-left">
                        <h2 class="text-2xl font-bold">{{ $match->awayTeam->name }}</h2>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if($match->status === 'finished') bg-green-100 text-green-800
                        @elseif($match->status === 'live') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        @if($match->status === 'finished') Terminé
                        @elseif($match->status === 'live') En direct
                        @else Programmé
                        @endif
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 text-sm text-center">
                @if($match->venue)
                    <div>
                        <span class="font-medium">Lieu:</span> {{ $match->venue }}
                    </div>
                @endif
                @if($match->round)
                    <div>
                        <span class="font-medium">Journée:</span> {{ $match->round }}
                    </div>
                @endif
            </div>
        </div>

        @if($match->events->count() > 0)
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Événements du match</h3>
                <ul class="space-y-2">
                    @foreach($match->events->sortBy('minute') as $event)
                        <li class="flex items-center justify-between py-2 border-b border-gray-200">
                            <div class="flex items-center space-x-4">
                                <span class="font-medium">{{ $event->minute }}'</span>
                                <span>
                                    @if($event->player)
                                        {{ $event->player->full_name }}
                                    @endif
                                    - 
                                    @if($event->type === 'goal') But
                                    @elseif($event->type === 'assist') Passe décisive
                                    @elseif($event->type === 'yellow_card') Carton jaune
                                    @elseif($event->type === 'red_card') Carton rouge
                                    @elseif($event->type === 'substitution') Remplacement
                                    @else {{ $event->type }}
                                    @endif
                                </span>
                            </div>
                            <span class="text-sm text-gray-500">
                                {{ $event->is_home_team ? $match->homeTeam->name : $match->awayTeam->name }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
@endsection

