<template>
    <Head :title="team.name" />

    <div class="min-h-screen bg-gray-100">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="mb-6">
                    <a href="/admin/teams" class="text-sm text-gray-500 hover:text-gray-700">← Retour aux équipes</a>
                </div>

                <div v-if="$page.props.flash?.success" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ $page.props.flash.success }}
                </div>

                <div class="bg-white shadow rounded-lg overflow-hidden mb-6">
                    <div class="p-6 flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ team.name }}</h1>
                            <p v-if="team.city" class="text-gray-500 mt-1">{{ team.city }}</p>
                            <p v-if="team.stadium" class="text-sm text-gray-500">{{ team.stadium }}</p>
                            <p v-if="team.founded_year" class="text-sm text-gray-500">Fondée en {{ team.founded_year }}</p>
                            <p v-if="team.description" class="mt-2 text-gray-600">{{ team.description }}</p>
                        </div>
                        <a :href="`/admin/teams/${team.slug}/edit`" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                            Modifier
                        </a>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Joueurs ({{ team.players?.length || 0 }})</h2>
                    <ul v-if="team.players?.length" class="divide-y divide-gray-200">
                        <li v-for="player in team.players" :key="player.id" class="py-3 flex justify-between">
                            <span class="font-medium">{{ player.first_name }} {{ player.last_name }}</span>
                            <span class="text-gray-500">{{ player.position || '-' }} {{ player.jersey_number ? '#' + player.jersey_number : '' }}</span>
                        </li>
                    </ul>
                    <p v-else class="text-gray-500">Aucun joueur</p>
                    <a :href="`/admin/players/create?team=${team.id}`" class="inline-block mt-4 text-blue-600 hover:text-blue-700 text-sm">+ Ajouter un joueur</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';

defineProps({
    team: Object,
});
</script>
