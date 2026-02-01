@extends('layouts.public')

@section('title', 'Équipes')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Équipes</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($teams as $team)
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 h-16 w-16 bg-gray-300 rounded-full flex items-center justify-center">
                                <span class="text-gray-600 font-bold text-xl">{{ $team->name[0] }}</span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    <a href="{{ route('public.team', $team->slug) }}" class="hover:text-blue-600">
                                        {{ $team->name }}
                                    </a>
                                </h3>
                                @if($team->city)
                                    <p class="text-sm text-gray-500">{{ $team->city }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="text-sm text-gray-600">
                            <p>{{ $team->players_count }} joueur{{ $team->players_count > 1 ? 's' : '' }}</p>
                            @if($team->stadium)
                                <p class="mt-1">Stade: {{ $team->stadium }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

