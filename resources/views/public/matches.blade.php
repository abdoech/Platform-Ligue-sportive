@extends('layouts.public')

@section('title', 'Matchs')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Matchs</h1>
            <form method="GET" action="{{ route('public.matches') }}">
                <select name="season" onchange="this.form.submit()" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Toutes les saisons</option>
                    @foreach($seasons as $season)
                        <option value="{{ $season }}" {{ request('season') == $season ? 'selected' : '' }}>
                            Saison {{ $season }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul class="divide-y divide-gray-200">
                @foreach($matches as $match)
                    <li>
                        <a href="{{ route('public.match', $match->id) }}" class="block hover:bg-gray-50">
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-1 text-right">
                                                <div class="text-sm font-medium text-gray-900">{{ $match->homeTeam->name }}</div>
                                            </div>
                                            <div class="text-center">
                                                @if($match->status === 'finished')
                                                    <span class="text-lg font-bold">{{ $match->home_score }} - {{ $match->away_score }}</span>
                                                @else
                                                    <span class="text-sm text-gray-500">{{ $match->match_date->format('d/m H:i') }}</span>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-sm font-medium text-gray-900">{{ $match->awayTeam->name }}</div>
                                            </div>
                                        </div>
                                        <div class="mt-2 text-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
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
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="mt-4">
            {{ $matches->links() }}
        </div>
    </div>
</div>
@endsection

