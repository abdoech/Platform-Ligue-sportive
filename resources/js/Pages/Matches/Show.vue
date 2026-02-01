<template>
    <Head :title="match.home_team?.name + ' vs ' + match.away_team?.name" />

    <div class="min-h-screen bg-gray-100">
        <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="mb-6">
                    <a href="/admin/matches" class="text-sm text-gray-500 hover:text-gray-700">← Retour aux matchs</a>
                </div>

                <div v-if="$page.props.flash?.success" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ $page.props.flash.success }}
                </div>

                <div class="bg-white shadow rounded-lg overflow-hidden mb-6">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex-1 text-right">
                                <div class="text-xl font-bold text-gray-900">{{ match.home_team?.name }}</div>
                            </div>
                            <div class="px-8 text-center">
                                <span v-if="match.status === 'finished'" class="text-3xl font-bold">
                                    {{ match.home_score }} - {{ match.away_score }}
                                </span>
                                <span v-else class="text-sm text-gray-500">{{ formatDateTime(match.match_date) }}</span>
                            </div>
                            <div class="flex-1 text-left">
                                <div class="text-xl font-bold text-gray-900">{{ match.away_team?.name }}</div>
                            </div>
                        </div>
                        <div class="text-center">
                            <span :class="getStatusBadgeClass(match.status)" class="px-3 py-1 text-sm font-semibold rounded-full">
                                {{ getStatusLabel(match.status) }}
                            </span>
                        </div>
                        <p v-if="match.venue" class="text-center text-gray-500 mt-2">{{ match.venue }}</p>
                    </div>
                </div>

                <div v-if="match.status !== 'finished' && match.status !== 'cancelled'" class="bg-white shadow rounded-lg p-6 mb-6">
                    <h2 class="text-lg font-semibold mb-4">Enregistrer le score</h2>
                    <form @submit.prevent="scoreForm.post(`/admin/matches/${match.id}/score`)" class="flex gap-4 items-end">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ match.home_team?.name }}</label>
                            <input v-model="scoreForm.home_score" type="number" min="0" required class="block w-full rounded-md border border-gray-300 px-3 py-2" />
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ match.away_team?.name }}</label>
                            <input v-model="scoreForm.away_score" type="number" min="0" required class="block w-full rounded-md border border-gray-300 px-3 py-2" />
                        </div>
                        <div>
                            <button type="submit" :disabled="scoreForm.processing" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded disabled:opacity-50">
                                Terminer le match
                            </button>
                        </div>
                    </form>
                </div>

                <div class="flex gap-3">
                    <a :href="`/admin/matches/${match.id}/edit`" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                        Modifier le match
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    match: Object,
});

const scoreForm = useForm({
    home_score: props.match.home_score ?? 0,
    away_score: props.match.away_score ?? 0,
    status: 'finished',
});

const formatDateTime = (dateString) => {
    if (!dateString) return '';
    return new Date(dateString).toLocaleString('fr-FR', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' });
};

const getStatusLabel = (status) => {
    const labels = { scheduled: 'Programmé', live: 'En direct', finished: 'Terminé', postponed: 'Reporté', cancelled: 'Annulé' };
    return labels[status] || status;
};

const getStatusBadgeClass = (status) => {
    const classes = { scheduled: 'bg-gray-100 text-gray-800', live: 'bg-red-100 text-red-800', finished: 'bg-green-100 text-green-800', postponed: 'bg-yellow-100 text-yellow-800', cancelled: 'bg-gray-100 text-gray-800' };
    return classes[status] || 'bg-gray-100 text-gray-800';
};
</script>
