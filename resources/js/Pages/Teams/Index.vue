<template>
    <Head title="Équipes" />

    <div class="min-h-screen bg-gray-100">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">Équipes</h1>
                    <a href="/admin/teams/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Nouvelle équipe
                    </a>
                </div>

                <div v-if="$page.props.flash?.success" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ $page.props.flash.success }}
                </div>

                <div class="bg-white shadow overflow-hidden sm:rounded-md">
                    <ul class="divide-y divide-gray-200">
                        <li v-for="team in teams" :key="team.id">
                            <a :href="`/admin/teams/${team.slug}`" class="block hover:bg-gray-50">
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-gray-300 rounded-full flex items-center justify-center">
                                                <span class="text-gray-600 font-semibold">{{ team.name.charAt(0) }}</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ team.name }}</div>
                                                <div class="text-sm text-gray-500">{{ team.city || 'Ville non spécifiée' }}</div>
                                            </div>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ team.players_count }} joueur{{ team.players_count > 1 ? 's' : '' }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';

defineProps({
    teams: Array,
});
</script>

