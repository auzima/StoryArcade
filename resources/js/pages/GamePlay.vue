<template>
    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- État de chargement -->
            <div v-if="loading" class="text-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-pink-500 mx-auto"></div>
                <p class="mt-4 text-gray-600 dark:text-gray-400">Chargement du jeu...</p>
            </div>

            <!-- Message d'erreur -->
            <div v-else-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Erreur !</strong>
                <span class="block sm:inline">{{ error }}</span>
            </div>

            <!-- Contenu du jeu -->
            <div v-else-if="currentGame" class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden">
                <!-- En-tête du jeu -->
                <div class="relative h-64">
                    <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                        <h1 class="text-4xl font-bold text-white">{{ currentGame.title }}</h1>
                    </div>
                </div>

                <!-- Description -->
                <div class="p-6">
                    <p class="text-gray-600 dark:text-gray-300 mb-6">
                        {{ currentGame.description }}
                    </p>

                    <!-- Bouton de démarrage -->
                    <div class="text-center">
                        <button @click="startGame" 
                                class="inline-flex items-center px-6 py-3 border border-transparent
                                       text-base font-medium rounded-md text-white bg-pink-500
                                       hover:bg-pink-600 focus:outline-none focus:ring-2
                                       focus:ring-offset-2 focus:ring-pink-500">
                            Commencer l'aventure
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useGames } from '../composables/useGames';
import { onMounted, watch, ref } from 'vue';
import { useRouter } from 'vue-router';

export default {
    name: 'GamePlay',
    props: {
        id: {
            type: [String, Number],
            required: true
        }
    },
    setup(props) {
        const router = useRouter();
        const { currentGame, loading, error, fetchGame } = useGames();

        // Utiliser les données initiales si disponibles
        if (window.initialData?.game) {
            currentGame.value = window.initialData.game;
        }

        const loadGame = async () => {
            // Si nous avons déjà les données initiales, ne pas recharger
            if (window.initialData?.game) {
                return;
            }

            try {
                await fetchGame(props.id);
            } catch (e) {
                console.error('Erreur lors du chargement du jeu:', e);
                // Rediriger vers la liste des jeux en cas d'erreur
                router.push({ name: 'games.list' });
            }
        };

        // Charger le jeu au montage du composant
        onMounted(loadGame);

        // Recharger le jeu si l'ID change
        watch(() => props.id, loadGame);

        const startGame = () => {
            console.log('Démarrage du jeu:', props.id);
        };

        return {
            currentGame,
            loading,
            error,
            startGame
        };
    }
}
</script>