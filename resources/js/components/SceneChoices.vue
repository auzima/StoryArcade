<template>
  <div>
    <a
      v-for="choice in choices"
      :key="choice.id"
      :href="routeBase + choice.next_scene"
      class="block bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600 transition"
    >
      👉 {{ choice.text }}
    </a>
  </div>
</template>

<script setup>
defineProps({
  choices: Array,
  routeBase: String,
});
</script>