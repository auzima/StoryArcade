<template>
  <div class="play-page min-h-screen bg-gray-900 text-white">
    <div class="container mx-auto px-4 py-8">
      <div class="bg-gray-800 rounded-lg shadow-xl p-6">
        <h1 class="text-3xl font-bold mb-6">Choisissez votre scène</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="scene in scenes"
            :key="scene.id"
            class="scene-card bg-gray-700 rounded-lg p-4 hover:bg-gray-600 transition duration-300 cursor-pointer"
            @click="navigateToScene(scene.id)"
          >
            <h2 class="text-xl font-semibold mb-2">{{ scene.title }}</h2>
            <p class="text-gray-300">{{ scene.description }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PlayPage',
  data() {
    return {
      scenes: [
        {
          id: 'Start',
          title: 'Le Début',
          description: 'Commencez votre aventure ici'
        },
        // Ajoutez d'autres scènes ici
      ]
    }
  },
  methods: {
    navigateToScene(sceneId) {
      this.$router.push(`/play/Scene/${sceneId}`)
    }
  }
}
</script>

<style scoped>
.scene-card {
  backdrop-filter: blur(4px);
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.scene-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
</style> 