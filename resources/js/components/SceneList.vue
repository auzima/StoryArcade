<template>
  <Layout>
    <div class="max-w-4xl mx-auto">
      <div class="bg-gray-900 shadow-xl rounded-lg p-8">
        <h1 class="text-4xl font-bold text-white mb-8 text-center">
          Scènes du Jeu
        </h1>

        <div v-if="loading" class="text-center text-white">
          <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-pink-500 mx-auto"></div>
          <p class="mt-4">Chargement…</p>
        </div>

        <div v-else class="grid gap-6">
          <RouterLink
            v-for="scene in scenes"
            :key="scene.id"
            :to="{ name: 'scene', params: { id: scene.id } }"
            class="block bg-gray-800 rounded-lg p-6 hover:bg-gray-700
                   transition-all duration-200 transform hover:scale-[1.02]
                   hover:shadow-lg hover:shadow-pink-500/10"
          >
            <h2 class="text-2xl font-semibold text-white mb-3">
              {{ scene.title }}
            </h2>
            <p class="text-gray-300 line-clamp-2">
              {{ scene.description }}
            </p>
          </RouterLink>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Layout from './Layout.vue';

export default {
  name: 'SceneList',
  components: {
    Layout
  },
  setup() {
    const scenes = ref([]);
    const loading = ref(true);

    const fetchScenes = async () => {
      try {
        const { data } = await axios.get('/api/v1/play/scenes');
        scenes.value = data;
      } catch (error) {
        console.error('Erreur lors du chargement des scènes:', error);
      } finally {
        loading.value = false;
      }
    };

    onMounted(fetchScenes);

    return {
      scenes,
      loading
    };
  }
}
</script> 