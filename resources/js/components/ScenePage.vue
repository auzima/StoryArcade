<template>
  <Layout>
    <div v-if="loading" class="text-center text-white">
      <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-pink-500 mx-auto"></div>
      <p class="mt-4">Chargement…</p>
    </div>

    <div v-else-if="scene" class="max-w-4xl mx-auto">
      <div class="bg-gray-900 shadow-xl rounded-lg p-8">
        <h1 class="text-4xl font-bold text-white mb-6 text-center">
          {{ scene.title }}
        </h1>

        <img v-if="scene.background"
             :src="scene.background"
             :alt="scene.title"
             class="mx-auto mb-8 rounded-lg shadow-lg max-h-96 w-full object-cover" />

        <div class="prose prose-invert mb-10 mx-auto" v-html="scene.description" />

        <h2 class="sr-only">Choix</h2>
        <div class="space-y-4">
          <RouterLink
            v-for="choice in scene.choices"
            :key="choice.id"
            :to="{ name: 'scene', params: { id: choice.next_scene } }"
            class="block w-full text-center px-6 py-3 rounded-md
                   bg-pink-500 hover:bg-pink-600 text-white font-medium
                   transition-all duration-200 transform hover:scale-105
                   hover:shadow-lg hover:shadow-pink-500/20"
          >
            {{ choice.title }}
          </RouterLink>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script>
import { ref, onMounted, watch } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';
import Layout from './Layout.vue';

export default {
  name: 'ScenePage',
  components: {
    Layout
  },
  setup() {
    const route = useRoute();
    const router = useRouter();
    const scene = ref(null);
    const loading = ref(true);

    const fetchScene = async (id) => {
      loading.value = true;
      try {
        const { data } = await axios.get(`/api/v1/play/scene/${id}`);
        scene.value = data;
      } catch (error) {
        console.error('Erreur lors du chargement de la scène:', error);
        router.replace('/play');
      } finally {
        loading.value = false;
      }
    };

    onMounted(() => fetchScene(route.params.id));
    watch(() => route.params.id, fetchScene);

    return {
      scene,
      loading
    };
  }
}
</script>

<style>
.prose {
  max-width: 65ch;
  margin-left: auto;
  margin-right: auto;
}

.prose-invert {
  color: #e5e7eb;
}

.prose-invert h1,
.prose-invert h2,
.prose-invert h3,
.prose-invert h4 {
  color: #f3f4f6;
  margin-top: 2em;
  margin-bottom: 1em;
}

.prose-invert p {
  margin-bottom: 1.5em;
  line-height: 1.8;
}

.prose-invert a {
  color: #ec4899;
  text-decoration: none;
  transition: color 0.2s;
}

.prose-invert a:hover {
  color: #db2777;
  text-decoration: underline;
}

.prose-invert ul,
.prose-invert ol {
  margin-top: 1em;
  margin-bottom: 1em;
  padding-left: 1.5em;
}

.prose-invert li {
  margin-bottom: 0.5em;
}

.prose-invert blockquote {
  border-left: 4px solid #ec4899;
  padding-left: 1em;
  margin-left: 0;
  margin-right: 0;
  font-style: italic;
  color: #9ca3af;
}
</style> 