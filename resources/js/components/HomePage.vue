<template>
  <div class="min-h-screen bg-black text-white flex flex-col justify-center items-center text-center px-4 space-y-6">
    <h1 class="text-3xl font-bold">
      Bienvenue sur <span class="text-pink-400">StoryArcade</span>
    </h1>

    <p class="max-w-xl text-lg">
      Découvrez une sélection de jeux narratifs où chaque décision façonne le cours de l'histoire.
    </p>

    <p class="max-w-xl text-base">
      Plongez dans des univers variés — fantastiques, mystérieux, futuristes ou réalistes — et vivez des aventures interactives uniques.
    </p>

    <div class="flex gap-4 mt-6">
      <a :href="getRoute('play.index')"
         class="btn-primary">
        🎮 Découvrir les jeux
      </a>

      <a v-if="hasRoute('login')"
         :href="getRoute('login')"
         class="btn-primary">
        🔐 Administration
      </a>
    </div>

    <div class="mt-6">
      <theme-toggle />
    </div>
  </div>
</template>

<script setup>
import ThemeToggle from './ThemeToggle.vue';
import { getCurrentInstance } from 'vue';

const { proxy } = getCurrentInstance();

const getRoute = (name) => {
  try {
    return proxy.$route(name);
  } catch (error) {
    console.error(`Erreur lors de la génération de la route ${name}:`, error);
    return '#';
  }
};

const hasRoute = (name) => {
  try {
    return proxy.$route().has(name);
  } catch (error) {
    console.error(`Erreur lors de la vérification de la route ${name}:`, error);
    return false;
  }
};
</script>