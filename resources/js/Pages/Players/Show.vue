<template>
    <Head :title="player.full_name" />

    <div class="min-h-screen bg-gray-100">
        <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="mb-6">
                    <a href="/admin/players" class="text-sm text-gray-500 hover:text-gray-700">← Retour aux joueurs</a>
                </div>

                <div v-if="$page.props.flash?.success" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ $page.props.flash.success }}
                </div>

                <div class="bg-white shadow rounded-lg overflow-hidden mb-6">
                    <div class="p-6 flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ player.full_name }}</h1>
                            <p v-if="player.team" class="text-gray-500 mt-1">{{ player.team.name }}</p>
                            <div class="mt-2 flex gap-4 text-sm text-gray-600">
                                <span v-if="player.position">Poste: {{ player.position }}</span>
                                <span v-if="player.jersey_number">#{{ player.jersey_number }}</span>
                                <span v-if="player.age">Âge: {{ player.age }} ans</span>
                                <span v-if="player.date_of_birth">Né le {{ formatDate(player.date_of_birth) }}</span>
                                <span v-if="player.nationality">{{ player.nationality }}</span>
                                <span v-if="player.height">{{ player.height }} cm</span>
                                <span v-if="player.weight">{{ player.weight }} kg</span>
                            </div>
                        </div>
                        <a :href="`/admin/players/${player.id}/edit`" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                            Modifier
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';

defineProps({
    player: Object,
});

const formatDate = (dateString) => {
    if (!dateString) return '';
    return new Date(dateString).toLocaleDateString('fr-FR');
};
</script>
