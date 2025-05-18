<template>
    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">
                Jeux disponibles
            </h1>

            <!-- État de chargement -->
            <div v-if="loading" class="text-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-pink-500 mx-auto"></div>
                <p class="mt-4 text-gray-600 dark:text-gray-400">Chargement des jeux...</p>
            </div>

            <!-- Message d'erreur -->
            <div v-else-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Erreur !</strong>
                <span class="block sm:inline">{{ error }}</span>
            </div>

            <!-- Liste des jeux -->
            <div v-else-if="games.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <game-card v-for="game in games" 
                          :key="game.id" 
                          :game="game" />
            </div>

            <!-- Aucun jeu disponible -->
            <div v-else class="text-center py-12">
                <p class="text-gray-600 dark:text-gray-400">
                    Aucun jeu n'est disponible pour le moment.
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import { useGames } from '../composables/useGames';
import GameCard from '../components/GameCard.vue';
import { onMounted } from 'vue';

export default {
    name: 'GamesList',
    components: {
        GameCard
    },
    setup() {
        const { games, loading, error, fetchGames } = useGames();

        // Charger les jeux au montage du composant
        onMounted(async () => {
            await fetchGames();
        });

        return { 
            games, 
            loading, 
            error 
        };
    }
}
</script> 