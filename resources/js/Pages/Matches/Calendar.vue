<template>
    <Head title="Calendrier des matchs" />

    <div class="min-h-screen bg-gray-100">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Calendrier des matchs</h1>

                <div class="mb-4">
                    <input
                        v-model="month"
                        type="month"
                        @change="loadMonth"
                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>

                <div class="bg-white shadow overflow-hidden sm:rounded-md">
                    <div v-for="(dayMatches, date) in matches" :key="date" class="border-b border-gray-200">
                        <div class="px-4 py-3 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ formatDate(date) }}
                            </h3>
                        </div>
                        <ul class="divide-y divide-gray-200">
                            <li v-for="match in dayMatches" :key="match.id" class="px-4 py-4">
                                <a :href="`/admin/matches/${match.id}`" class="block">
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
                                                        {{ formatTime(match.match_date) }}
                                                    </span>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="text-sm font-medium text-gray-900">{{ match.away_team.name }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <span :class="getStatusBadgeClass(match.status)" class="px-2 py-1 text-xs font-semibold rounded-full">
                                                {{ getStatusLabel(match.status) }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, router } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const props = defineProps({
    matches: Object,
    currentMonth: String,
});

const month = ref(props.currentMonth);

const loadMonth = () => {
    router.get(route('admin.matches.calendar'), { month: month.value }, {
        preserveState: true,
        preserveScroll: true,
    });
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
};

const formatTime = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
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

