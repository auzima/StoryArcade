<template>
  <div class="min-h-screen bg-black text-gray-300">
    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-700">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex justify-between">
        <a href="/" class="flex items-center text-2xl font-bold text-gray-800 dark:text-white">
          Sauvage&nbsp;Lune
        </a>

        <div class="flex items-center gap-6">
          <a href="/play" class="text-sm hover:text-white">
            🎮 Jouer
          </a>
          <a href="/login" class="text-sm hover:text-white">
            🔐 Administration
          </a>
        </div>
      </div>
    </nav>

    <!-- Contenu spécifique injecté -->
    <main class="py-12 px-4 sm:px-6 lg:px-8">
      <slot />
    </main>
  </div>
</template>

<script>
export default {
  name: 'Layout'
}
</script> 