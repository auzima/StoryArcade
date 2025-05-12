<script setup>
  import { useFetchJson } from '@/composables/useFetchJson';

  const { data: test } = useFetchJson('test');
  const { data: delTest, error: delError} = useFetchJson({url: 'test', method: 'DELETE' });

  const {
    data: time,
    error: timeError,
    loading: timeLoading,
    execute: executeTimeFetch,
    abort: abortTimeFetch
  } = useFetchJson({url: 'time', immediate: false});

  function timeFetch() {
    executeTimeFetch({timeClient: new Date()});
  }
</script>

<template>
  <div class="p-6">
    <h1 class="text-3xl font-bold mb-6">Page Example</h1>
    <div class="space-y-4">
      <p class="text-gray-300">{{ test }}</p>
      <p class="text-gray-300">{{ delTest }}</p>
      <p class="text-red-400" v-if="delError">{{ delError }}</p>
      <div class="space-x-4">
        <button @click="timeFetch()" :disabled="timeLoading" class="btn-primary">
          Fetch time
        </button>
        <button @click="abortTimeFetch()" :disabled="!timeLoading" class="btn-primary">
          Abort
        </button>
      </div>
      <p v-if="timeLoading" class="text-yellow-400">Loading...</p>
      <p v-if="time" class="text-gray-300">{{ time }}</p>
      <p v-if="timeError" class="text-red-400">{{ timeError }}</p>
    </div>
  </div>
</template>

<style scoped>
button:disabled {
  @apply opacity-50 cursor-not-allowed;
}
</style>