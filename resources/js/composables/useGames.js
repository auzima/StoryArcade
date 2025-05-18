import { ref, onMounted, computed } from "vue";
import { useGamesStore } from "../stores/games";

export function useGames() {
    const store = useGamesStore();
    const loading = ref(false);
    const error = ref(null);

    const fetchGames = async () => {
        if (loading.value) return; // Éviter les appels multiples

        loading.value = true;
        error.value = null;

        try {
            await store.fetchGames();
        } catch (e) {
            error.value =
                e.message ||
                "Une erreur est survenue lors du chargement des jeux";
            console.error("Erreur lors du chargement des jeux:", e);
        } finally {
            loading.value = false;
        }
    };

    const fetchGame = async (id) => {
        if (loading.value) return; // Éviter les appels multiples

        loading.value = true;
        error.value = null;

        try {
            await store.fetchGame(id);
        } catch (e) {
            error.value =
                e.message ||
                "Une erreur est survenue lors du chargement du jeu";
            console.error("Erreur lors du chargement du jeu:", e);
        } finally {
            loading.value = false;
        }
    };

    // Utiliser computed pour réagir aux changements du store
    const games = computed(() => store.games);
    const currentGame = computed(() => store.currentGame);

    onMounted(() => {
        fetchGames();
    });

    return {
        games,
        currentGame,
        loading,
        error,
        fetchGames,
        fetchGame,
    };
}
