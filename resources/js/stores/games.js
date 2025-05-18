import { defineStore } from "pinia";
import axios from "axios";

export const useGamesStore = defineStore("games", {
    state: () => ({
        games: [],
        currentGame: null,
        loading: false,
        error: null,
    }),

    getters: {
        publishedGames: (state) =>
            state.games.filter((game) => game.is_published),
        gameById: (state) => (id) => state.games.find((game) => game.id === id),
    },

    actions: {
        async fetchGames() {
            this.loading = true;
            this.error = null;

            try {
                const response = await axios.get("/api/v1/games");
                this.games = response.data.data;
                return this.games;
            } catch (error) {
                this.error =
                    error.response?.data?.message ||
                    "Une erreur est survenue lors du chargement des jeux";
                console.error("Erreur lors du chargement des jeux:", error);
                throw error;
            } finally {
                this.loading = false;
            }
        },

        async fetchGame(id) {
            this.loading = true;
            this.error = null;

            try {
                const response = await axios.get(`/api/v1/games/${id}`);
                this.currentGame = response.data.data;
                return this.currentGame;
            } catch (error) {
                this.error =
                    error.response?.data?.message ||
                    "Une erreur est survenue lors du chargement du jeu";
                console.error("Erreur lors du chargement du jeu:", error);
                throw error;
            } finally {
                this.loading = false;
            }
        },

        clearCurrentGame() {
            this.currentGame = null;
        },
    },
});
