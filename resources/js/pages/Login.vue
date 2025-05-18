<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">
                Administration
            </h2>

            <form @submit.prevent="handleSubmit">
                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input
                        id="email"
                        type="email"
                        v-model="form.email"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                        required
                        autofocus
                    />
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="password">
                        Mot de passe
                    </label>
                    <input
                        id="password"
                        type="password"
                        v-model="form.password"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                        required
                    />
                </div>

                <!-- Error Message -->
                <div v-if="error" class="mb-4 text-red-500 text-sm">
                    {{ error }}
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end">
                    <button
                        type="submit"
                        class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        :disabled="loading"
                    >
                        {{ loading ? 'Connexion...' : 'Se connecter' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../stores/auth'

export default {
    name: 'Login',
    setup() {
        const router = useRouter()
        const authStore = useAuthStore()
        const form = ref({
            email: '',
            password: ''
        })
        const error = ref('')
        const loading = ref(false)

        const handleSubmit = async () => {
            try {
                loading.value = true
                error.value = ''
                const success = await authStore.login(form.value)
                if (success) {
                    router.push({ name: 'admin' })
                } else {
                    error.value = 'Identifiants invalides'
                }
            } catch (e) {
                error.value = 'Une erreur est survenue lors de la connexion'
                console.error('Erreur de connexion:', e)
            } finally {
                loading.value = false
            }
        }

        return {
            form,
            error,
            loading,
            handleSubmit
        }
    }
}
</script>