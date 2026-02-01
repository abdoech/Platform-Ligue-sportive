<template>
    <Head title="Modifier le match" />

    <div class="min-h-screen bg-gray-100">
        <div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="mb-6">
                    <a :href="`/admin/matches/${match.id}`" class="text-sm text-gray-500 hover:text-gray-700">← Retour au match</a>
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-6">Modifier le match</h1>

                <form @submit.prevent="form.put(`/admin/matches/${match.id}`)" class="bg-white shadow rounded-lg p-6 space-y-4">
                    <div>
                        <label for="home_team_id" class="block text-sm font-medium text-gray-700">Équipe domicile *</label>
                        <select id="home_team_id" v-model="form.home_team_id" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2">
                            <option v-for="team in teams" :key="team.id" :value="team.id">{{ team.name }}</option>
                        </select>
                        <p v-if="form.errors.home_team_id" class="mt-1 text-sm text-red-600">{{ form.errors.home_team_id }}</p>
                    </div>

                    <div>
                        <label for="away_team_id" class="block text-sm font-medium text-gray-700">Équipe extérieur *</label>
                        <select id="away_team_id" v-model="form.away_team_id" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2">
                            <option v-for="team in teams" :key="team.id" :value="team.id">{{ team.name }}</option>
                        </select>
                        <p v-if="form.errors.away_team_id" class="mt-1 text-sm text-red-600">{{ form.errors.away_team_id }}</p>
                    </div>

                    <div>
                        <label for="match_date" class="block text-sm font-medium text-gray-700">Date et heure *</label>
                        <input id="match_date" v-model="form.match_date" type="datetime-local" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" />
                        <p v-if="form.errors.match_date" class="mt-1 text-sm text-red-600">{{ form.errors.match_date }}</p>
                    </div>

                    <div>
                        <label for="venue" class="block text-sm font-medium text-gray-700">Lieu</label>
                        <input id="venue" v-model="form.venue" type="text" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                            <select id="status" v-model="form.status" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2">
                                <option value="scheduled">Programmé</option>
                                <option value="live">En direct</option>
                                <option value="finished">Terminé</option>
                                <option value="postponed">Reporté</option>
                                <option value="cancelled">Annulé</option>
                            </select>
                        </div>
                        <div>
                            <label for="round" class="block text-sm font-medium text-gray-700">Journée</label>
                            <input id="round" v-model="form.round" type="number" min="1" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" />
                        </div>
                    </div>

                    <div>
                        <label for="season" class="block text-sm font-medium text-gray-700">Saison</label>
                        <select id="season" v-model="form.season" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2">
                            <option value="">Sélectionner</option>
                            <option v-for="s in seasons" :key="s" :value="s">{{ s }}</option>
                        </select>
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea id="notes" v-model="form.notes" rows="2" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" />
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit" :disabled="form.processing" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded disabled:opacity-50">
                            Enregistrer
                        </button>
                        <a :href="`/admin/matches/${match.id}`" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    match: Object,
    teams: Array,
    seasons: Array,
});

const matchDate = props.match.match_date ? new Date(props.match.match_date) : new Date();
const formattedDate = matchDate.toISOString().slice(0, 16);

const form = useForm({
    home_team_id: props.match.home_team_id,
    away_team_id: props.match.away_team_id,
    match_date: formattedDate,
    venue: props.match.venue || '',
    status: props.match.status,
    round: props.match.round || null,
    season: props.match.season || '',
    notes: props.match.notes || '',
});
</script>
