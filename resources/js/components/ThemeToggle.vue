<template>
  <button @click="toggleTheme" class="px-4 py-2 rounded bg-gray-200 dark:bg-gray-700 text-black dark:text-white">
    {{ isDarkMode ? '☀️ Mode clair' : '🌙 Mode sombre' }}
  </button>
</template>

<script setup>
import { ref, watch } from 'vue';

const isDarkMode = ref(localStorage.getItem('theme') === 'dark');

// Applique la classe au chargement initial
document.documentElement.classList.toggle('dark', isDarkMode.value);

watch(isDarkMode, (enabled) => {
  localStorage.setItem('theme', enabled ? 'dark' : 'light');
  document.documentElement.classList.toggle('dark', enabled);
});

const toggleTheme = () => {
  isDarkMode.value = !isDarkMode.value;
};
</script>