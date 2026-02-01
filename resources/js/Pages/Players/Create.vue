<template>
    <Head title="Ajouter un joueur" />

    <div class="min-h-screen bg-gray-100">
        <div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="mb-6">
                    <a href="/admin/players" class="text-sm text-gray-500 hover:text-gray-700">← Retour aux joueurs</a>
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-6">Ajouter un joueur</h1>

                <form @submit.prevent="form.post('/admin/players')" class="bg-white shadow rounded-lg p-6 space-y-4">
                    <div>
                        <label for="team_id" class="block text-sm font-medium text-gray-700">Équipe *</label>
                        <select id="team_id" v-model="form.team_id" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2">
                            <option value="">Sélectionner une équipe</option>
                            <option v-for="team in teams" :key="team.id" :value="team.id">{{ team.name }}</option>
                        </select>
                        <p v-if="form.errors.team_id" class="mt-1 text-sm text-red-600">{{ form.errors.team_id }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">Prénom *</label>
                            <input id="first_name" v-model="form.first_name" type="text" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" />
                            <p v-if="form.errors.first_name" class="mt-1 text-sm text-red-600">{{ form.errors.first_name }}</p>
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Nom *</label>
                            <input id="last_name" v-model="form.last_name" type="text" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" />
                            <p v-if="form.errors.last_name" class="mt-1 text-sm text-red-600">{{ form.errors.last_name }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700">Poste</label>
                            <input id="position" v-model="form.position" type="text" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" placeholder="ex: Gardien, Défenseur" />
                            <p v-if="form.errors.position" class="mt-1 text-sm text-red-600">{{ form.errors.position }}</p>
                        </div>
                        <div>
                            <label for="jersey_number" class="block text-sm font-medium text-gray-700">Numéro</label>
                            <input id="jersey_number" v-model="form.jersey_number" type="number" min="1" max="99" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" />
                            <p v-if="form.errors.jersey_number" class="mt-1 text-sm text-red-600">{{ form.errors.jersey_number }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date de naissance</label>
                            <input id="date_of_birth" v-model="form.date_of_birth" type="date" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" />
                            <p v-if="form.errors.date_of_birth" class="mt-1 text-sm text-red-600">{{ form.errors.date_of_birth }}</p>
                        </div>
                        <div>
                            <label for="nationality" class="block text-sm font-medium text-gray-700">Nationalité</label>
                            <input id="nationality" v-model="form.nationality" type="text" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" />
                            <p v-if="form.errors.nationality" class="mt-1 text-sm text-red-600">{{ form.errors.nationality }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="height" class="block text-sm font-medium text-gray-700">Taille (cm)</label>
                            <input id="height" v-model="form.height" type="number" min="100" max="250" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" />
                            <p v-if="form.errors.height" class="mt-1 text-sm text-red-600">{{ form.errors.height }}</p>
                        </div>
                        <div>
                            <label for="weight" class="block text-sm font-medium text-gray-700">Poids (kg)</label>
                            <input id="weight" v-model="form.weight" type="number" min="40" max="150" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" />
                            <p v-if="form.errors.weight" class="mt-1 text-sm text-red-600">{{ form.errors.weight }}</p>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit" :disabled="form.processing" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded disabled:opacity-50">
                            Créer le joueur
                        </button>
                        <a href="/admin/players" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    teams: Array,
    teamId: Number,
});

const form = useForm({
    team_id: props.teamId || '',
    first_name: '',
    last_name: '',
    position: '',
    jersey_number: null,
    date_of_birth: '',
    nationality: '',
    height: null,
    weight: null,
});
</script>
