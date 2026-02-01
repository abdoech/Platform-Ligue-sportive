<template>
    <Head title="Planifier un match" />

    <div class="min-h-screen bg-gray-100">
        <div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="mb-6">
                    <a href="/admin/matches" class="text-sm text-gray-500 hover:text-gray-700">← Retour aux matchs</a>
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-6">Planifier un match</h1>

                <form @submit.prevent="form.post('/admin/matches')" class="bg-white shadow rounded-lg p-6 space-y-4">
                    <div>
                        <label for="home_team_id" class="block text-sm font-medium text-gray-700">Équipe domicile *</label>
                        <select id="home_team_id" v-model="form.home_team_id" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2">
                            <option value="">Sélectionner</option>
                            <option v-for="team in teams" :key="team.id" :value="team.id">{{ team.name }}</option>
                        </select>
                        <p v-if="form.errors.home_team_id" class="mt-1 text-sm text-red-600">{{ form.errors.home_team_id }}</p>
                    </div>

                    <div>
                        <label for="away_team_id" class="block text-sm font-medium text-gray-700">Équipe extérieur *</label>
                        <select id="away_team_id" v-model="form.away_team_id" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2">
                            <option value="">Sélectionner</option>
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
                        <input id="venue" v-model="form.venue" type="text" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" placeholder="Stade..." />
                        <p v-if="form.errors.venue" class="mt-1 text-sm text-red-600">{{ form.errors.venue }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="round" class="block text-sm font-medium text-gray-700">Journée</label>
                            <input id="round" v-model="form.round" type="number" min="1" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" />
                            <p v-if="form.errors.round" class="mt-1 text-sm text-red-600">{{ form.errors.round }}</p>
                        </div>
                        <div>
                            <label for="season" class="block text-sm font-medium text-gray-700">Saison</label>
                            <select id="season" v-model="form.season" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2">
                                <option value="">Sélectionner</option>
                                <option v-for="s in seasons" :key="s" :value="s">{{ s }}</option>
                                <option :value="currentYear">{{ currentYear }}</option>
                            </select>
                            <p v-if="form.errors.season" class="mt-1 text-sm text-red-600">{{ form.errors.season }}</p>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit" :disabled="form.processing" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded disabled:opacity-50">
                            Créer le match
                        </button>
                        <a href="/admin/matches" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    teams: Array,
    seasons: Array,
});

const currentYear = new Date().getFullYear().toString();

const form = useForm({
    home_team_id: '',
    away_team_id: '',
    match_date: '',
    venue: '',
    round: null,
    season: '',
});
</script>
