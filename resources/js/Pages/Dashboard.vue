<template>
    <Head title="Tableau de bord" />

    <div class="min-h-screen bg-gray-100">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Tableau de bord</h1>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <a href="/admin/teams" class="bg-white overflow-hidden shadow rounded-lg block hover:shadow-md transition-shadow">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Équipes</dt>
                                        <dd class="text-lg font-medium text-gray-900">{{ teamsCount }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="/admin/players" class="bg-white overflow-hidden shadow rounded-lg block hover:shadow-md transition-shadow">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Joueurs</dt>
                                        <dd class="text-lg font-medium text-gray-900">{{ playersCount }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="/admin/matches" class="bg-white overflow-hidden shadow rounded-lg block hover:shadow-md transition-shadow">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Matchs</dt>
                                        <dd class="text-lg font-medium text-gray-900">{{ matchesCount }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-xl font-semibold mb-4">Actions rapides</h2>
                        <div class="space-y-2">
                            <a href="/admin/teams/create" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                Créer une équipe
                            </a>
                            <a href="/admin/players/create" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                Ajouter un joueur
                            </a>
                            <a href="/admin/matches/create" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                Planifier un match
                            </a>
                            <a href="/admin/matches/calendar" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                Voir le calendrier
                            </a>
                        </div>
                    </div>

                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-xl font-semibold mb-4">Navigation</h2>
                        <div class="space-y-2">
                            <a href="/admin/teams" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                Gérer les équipes
                            </a>
                            <a href="/admin/players" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                Gérer les joueurs
                            </a>
                            <a href="/admin/matches" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                Gérer les matchs
                            </a>
                            <a href="/admin/standings" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                Voir les classements
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';

defineProps({
    teamsCount: { type: Number, default: 0 },
    playersCount: { type: Number, default: 0 },
    matchesCount: { type: Number, default: 0 },
});
</script>
