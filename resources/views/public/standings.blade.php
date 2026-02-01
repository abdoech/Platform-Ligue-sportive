@extends('layouts.public')

@section('title', 'Classements')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Classements</h1>
            <form method="GET" action="{{ route('public.standings') }}">
                <select name="season" onchange="this.form.submit()" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @foreach($seasons as $season)
                        <option value="{{ $season }}" {{ $season == $currentSeason ? 'selected' : '' }}>
                            Saison {{ $season }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pos</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Équipe</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">J</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">G</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">N</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">P</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">BP</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">BC</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">DB</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Pts</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($standings as $standing)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $standing->position }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('public.team', $standing->team->slug) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                    {{ $standing->team->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">{{ $standing->played }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">{{ $standing->won }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">{{ $standing->drawn }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">{{ $standing->lost }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">{{ $standing->goals_for }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">{{ $standing->goals_against }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                {{ $standing->goal_difference > 0 ? '+' : '' }}{{ $standing->goal_difference }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-center">{{ $standing->points }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

