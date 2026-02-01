<template>
    <Head :title="'Modifier ' + team.name" />

    <div class="min-h-screen bg-gray-100">
        <div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="mb-6">
                    <a :href="`/admin/teams/${team.slug}`" class="text-sm text-gray-500 hover:text-gray-700">← Retour à l'équipe</a>
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-6">Modifier {{ team.name }}</h1>

                <form @submit.prevent="form.put(`/admin/teams/${team.slug}`)" class="bg-white shadow rounded-lg p-6 space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom *</label>
                        <input
                            id="name"
                            v-model="form.name"
                            type="text"
                            required
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                        />
                        <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
                    </div>

                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">Ville</label>
                        <input
                            id="city"
                            v-model="form.city"
                            type="text"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                        />
                        <p v-if="form.errors.city" class="mt-1 text-sm text-red-600">{{ form.errors.city }}</p>
                    </div>

                    <div>
                        <label for="stadium" class="block text-sm font-medium text-gray-700">Stade</label>
                        <input
                            id="stadium"
                            v-model="form.stadium"
                            type="text"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                        />
                        <p v-if="form.errors.stadium" class="mt-1 text-sm text-red-600">{{ form.errors.stadium }}</p>
                    </div>

                    <div>
                        <label for="founded_year" class="block text-sm font-medium text-gray-700">Année de fondation</label>
                        <input
                            id="founded_year"
                            v-model="form.founded_year"
                            type="number"
                            min="1800"
                            :max="new Date().getFullYear()"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                        />
                        <p v-if="form.errors.founded_year" class="mt-1 text-sm text-red-600">{{ form.errors.founded_year }}</p>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea
                            id="description"
                            v-model="form.description"
                            rows="3"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                        />
                        <p v-if="form.errors.description" class="mt-1 text-sm text-red-600">{{ form.errors.description }}</p>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded disabled:opacity-50"
                        >
                            Enregistrer
                        </button>
                        <a :href="`/admin/teams/${team.slug}`" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    team: Object,
});

const form = useForm({
    name: props.team.name,
    city: props.team.city || '',
    stadium: props.team.stadium || '',
    founded_year: props.team.founded_year || null,
    description: props.team.description || '',
});
</script>
