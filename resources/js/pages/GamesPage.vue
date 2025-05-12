<script setup>
import { ref, onMounted, computed } from 'vue';
import { useFetchJson } from '@/composables/useFetchJson';

const games = ref([]);
const loading = ref(true);
const error = ref(null);
const searchQuery = ref('');
const selectedDifficulty = ref('all');

const { data, error: fetchError, loading: fetchLoading } = useFetchJson('/api/v1/games');

onMounted(async () => {
  if (data.value) {
    games.value = data.value.data;
  }
  loading.value = fetchLoading.value;
  error.value = fetchError.value;
});

const filteredGames = computed(() => {
  return games.value.filter(game => {
    const matchesSearch = game.title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
                         game.description.toLowerCase().includes(searchQuery.value.toLowerCase());
    const matchesDifficulty = selectedDifficulty.value === 'all' || game.difficulty === selectedDifficulty.value;
    return matchesSearch && matchesDifficulty;
  });
});

const difficulties = ['Facile', 'Moyen', 'Difficile'];
</script>

<template>
  <div class="min-h-screen bg-black text-white p-6">
    <div class="max-w-7xl mx-auto">
      <h1 class="text-4xl font-bold mb-8">Découvrez nos jeux</h1>

      <!-- Filtres -->
      <div class="mb-8 flex flex-col md:flex-row gap-4">
        <input
          v-model="searchQuery"
          type="text"
          placeholder="Rechercher un jeu..."
          class="px-4 py-2 rounded bg-gray-800 text-white border border-gray-700 focus:border-pink-500 focus:outline-none"
        >
        <select
          v-model="selectedDifficulty"
          class="px-4 py-2 rounded bg-gray-800 text-white border border-gray-700 focus:border-pink-500 focus:outline-none"
        >
          <option value="all">Toutes les difficultés</option>
          <option v-for="diff in difficulties" :key="diff" :value="diff">{{ diff }}</option>
        </select>
      </div>

      <div v-if="loading" class="text-center py-12">
        <p class="text-yellow-400">Chargement des jeux...</p>
      </div>

      <div v-else-if="error" class="text-center py-12">
        <p class="text-red-400">Une erreur est survenue lors du chargement des jeux.</p>
      </div>

      <div v-else-if="filteredGames.length === 0" class="text-center py-12">
        <p class="text-gray-400">Aucun jeu ne correspond à votre recherche.</p>
      </div>

      <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="game in filteredGames" :key="game.id" 
             class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
          <img :src="game.thumbnail" :alt="game.title" class="w-full h-48 object-cover">
          <div class="p-6">
            <h2 class="text-2xl font-bold mb-2">{{ game.title }}</h2>
            <p class="text-gray-300 mb-4">{{ game.description }}</p>
            
            <div class="space-y-2 mb-4">
              <div class="flex items-center text-sm text-gray-400">
                <span class="mr-2">👤</span>
                {{ game.author?.name || 'Anonyme' }}
              </div>
              <div class="flex items-center text-sm text-gray-400">
                <span class="mr-2">⏱️</span>
                {{ game.estimated_duration }}
              </div>
              <div class="flex items-center text-sm text-gray-400">
                <span class="mr-2">🎯</span>
                {{ game.difficulty }}
              </div>
            </div>

            <div class="flex justify-between items-center">
              <span class="text-sm text-gray-400">{{ game.scenes_count }} scènes</span>
              <a :href="route('play.start', { game: game.id })" 
                 class="btn-primary">
                Jouer
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template> 