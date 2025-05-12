<script setup>
  import { ref } from 'vue';
  import TheHeader from '@/components/TheHeader.vue';
  import PageExample from '@/pages/PageExample.vue';
  const n = ref(1);
</script>

<template>
  <div class="min-h-screen bg-black text-white">
    <TheHeader />
    <main>
      <PageExample />
    </main>
  </div>
</template>

<style>
  .btn-primary {
    @apply bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded transition-colors duration-200;
  }
</style>