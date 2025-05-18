<template>
    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Administration
                </h1>
                <button @click="logout" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Se déconnecter
                </button>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                    Bienvenue, {{ user?.name }}
                </h2>
                <p class="text-gray-600 dark:text-gray-300">
                    Vous êtes connecté en tant qu'administrateur.
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import { useRouter } from 'vue-router';
import { useAuthStore } from '../stores/auth';

export default {
    name: 'Admin',
    setup() {
        const router = useRouter();
        const authStore = useAuthStore();

        const logout = async () => {
            await authStore.logout();
            router.push('/login');
        };

        return {
            user: authStore.user,
            logout
        };
    }
}
</script> 