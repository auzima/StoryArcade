<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Navigation -->
        <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <router-link to="/" class="text-2xl font-bold text-gray-800 dark:text-white">
                                Sauvage Lune
                            </router-link>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <router-link to="/play" class="text-sm text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-md font-medium">
                            🎮 Jouer
                        </router-link>
                        <router-link to="/login" class="text-sm text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-md font-medium">
                            🔐 Administration
                        </router-link>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Contenu principal -->
        <main>
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
export default {
    name: 'App'
}
</script>

