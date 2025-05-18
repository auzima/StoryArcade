<template>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
        <img v-if="game.cover_image" 
             :src="game.cover_image" 
             :alt="game.title" 
             class="w-full h-48 object-cover">
        <div v-else class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
            <span class="text-gray-400 dark:text-gray-500">Pas d'image</span>
        </div>

        <div class="p-6">
            <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">{{ game.title }}</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-4">{{ game.description }}</p>

            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    <span class="mr-4">{{ game.scenes_count }} scènes</span>
                    <span>{{ game.choices_count }} choix</span>
                </div>
                <router-link :to="{ name: 'games.play', params: { id: game.id }}"
                           class="inline-flex items-center px-4 py-2 bg-pink-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-600 focus:bg-pink-600 active:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Jouer
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'GameCard',
    props: {
        game: {
            type: Object,
            required: true
        }
    }
}
</script>
