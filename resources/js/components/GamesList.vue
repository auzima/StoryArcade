<template>
  <div class="min-h-screen bg-black text-white flex flex-col items-center px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">
      🎮 Jeux disponibles
    </h1>

    <div v-if="loading" class="text-center">
      <p class="text-lg">Chargement des jeux...</p>
    </div>

    <div v-else-if="error" class="text-center text-red-500">
      <p class="text-lg">{{ error }}</p>
    </div>

    <div v-else-if="games.length === 0" class="text-center">
      <p class="text-lg text-gray-400">Aucun jeu disponible pour le moment.</p>
    </div>

    <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl w-full">
      <div v-for="game in games" :key="game.id" 
           class="bg-gray-800 rounded-lg overflow-hidden shadow-lg transition-transform hover:scale-105">
        <div class="aspect-w-16 aspect-h-9">
          <img v-if="game.cover_image" 
               :src="game.cover_image" 
               :alt="game.title"
               class="w-full h-48 object-cover">
          <div v-else 
               class="w-full h-48 bg-gray-700 flex items-center justify-center text-gray-400">
            Pas d'image
          </div>
        </div>

        <div class="p-6">
          <h2 class="text-xl font-semibold mb-2">{{ game.title }}</h2>
          <div class="text-sm text-gray-400 mb-3">
            <p>Par {{ game.author }} • v{{ game.version }}</p>
          </div>
          <p class="text-gray-300 mb-6 whitespace-pre-line">{{ game.description }}</p>
          
          <a :href="`/play/${game.id}/start`" 
             class="btn-primary w-full text-center">
            ▶️ Jouer
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const games = ref([])
const loading = ref(true)
const error = ref(null)

const fetchGames = async () => {
  try {
    loading.value = true
    error.value = null
    
    const response = await fetch('http://127.0.0.1:8001/api/v1/games', {
      method: 'GET',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
      }
    })

    if (!response.ok) {
      throw new Error(`Erreur HTTP: ${response.status}`)
    }

    const data = await response.json()
    games.value = data.data
  } catch (err) {
    console.error('Erreur détaillée:', err)
    error.value = 'Impossible de charger les jeux. Veuillez réessayer plus tard.'
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchGames()
})
</script>

<style scoped>
.btn-primary {
  @apply bg-pink-500 text-white px-6 py-3 rounded-lg font-medium 
         hover:bg-pink-600 transition-colors duration-200 
         focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-opacity-50;
}
</style> 