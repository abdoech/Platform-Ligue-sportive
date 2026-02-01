<template>
    <Head title="Matchs" />

    <div class="min-h-screen bg-gray-100">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">Matchs</h1>
                    <a href="/admin/matches/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Nouveau match
                    </a>
                </div>

                <div class="mb-4 flex space-x-4">
                    <select v-model="filters.season" @change="filter" class="rounded-md border-gray-300 shadow-sm">
                        <option value="">Toutes les saisons</option>
                        <option v-for="season in seasons" :key="season" :value="season">
                            Saison {{ season }}
                        </option>
                    </select>
                    <select v-model="filters.status" @change="filter" class="rounded-md border-gray-300 shadow-sm">
                        <option value="">Tous les statuts</option>
                        <option value="scheduled">Programmé</option>
                        <option value="live">En direct</option>
                        <option value="finished">Terminé</option>
                    </select>
                </div>

                <div v-if="$page.props.flash?.success" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ $page.props.flash.success }}
                </div>

                <div class="bg-white shadow overflow-hidden sm:rounded-md">
                    <ul class="divide-y divide-gray-200">
                        <li v-for="match in matches.data" :key="match.id">
                            <a :href="`/admin/matches/${match.id}`" class="block hover:bg-gray-50">
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-1 text-right">
                                                    <div class="text-sm font-medium text-gray-900">{{ match.home_team.name }}</div>
                                                </div>
                                                <div class="text-center">
                                                    <span v-if="match.status === 'finished'" class="text-lg font-bold">
                                                        {{ match.home_score }} - {{ match.away_score }}
                                                    </span>
                                                    <span v-else class="text-sm text-gray-500">
                                                        {{ formatDate(match.match_date) }}
                                                    </span>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="text-sm font-medium text-gray-900">{{ match.away_team.name }}</div>
                                                </div>
                                            </div>
                                            <div class="mt-2 text-center">
                                                <span :class="getStatusBadgeClass(match.status)" class="px-2 py-1 text-xs font-semibold rounded-full">
                                                    {{ getStatusLabel(match.status) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="mt-4">
                    <div v-if="matches.links" class="flex justify-center gap-1">
                        <template v-for="link in matches.links" :key="link.label">
                            <a v-if="link.url" :href="link.url" v-html="link.label" 
                                :class="['px-3 py-2 text-sm leading-4 border rounded hover:bg-gray-50', link.active ? 'bg-blue-500 text-white' : '']">
                            </a>
                            <span v-else v-html="link.label" class="px-3 py-2 text-sm leading-4 border rounded text-gray-400"></span>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, router } from '@inertiajs/vue3';
import { reactive } from 'vue';

const props = defineProps({
    matches: Object,
    seasons: Array,
    filters: Object,
});

const filters = reactive(props.filters || {});

const filter = () => {
    router.get('/admin/matches', filters, {
        preserveState: true,
        preserveScroll: true,
    });
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' });
};

const getStatusLabel = (status) => {
    const labels = {
        scheduled: 'Programmé',
        live: 'En direct',
        finished: 'Terminé',
        postponed: 'Reporté',
        cancelled: 'Annulé',
    };
    return labels[status] || status;
};

const getStatusBadgeClass = (status) => {
    const classes = {
        scheduled: 'bg-gray-100 text-gray-800',
        live: 'bg-red-100 text-red-800',
        finished: 'bg-green-100 text-green-800',
        postponed: 'bg-yellow-100 text-yellow-800',
        cancelled: 'bg-gray-100 text-gray-800',
    };
    return classes[status] || 'bg-gray-100 text-gray-800';
};
</script>

