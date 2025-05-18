import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        user: null,
        token: localStorage.getItem("token"),
        loading: false,
        error: null,
    }),

    getters: {
        isAuthenticated: (state) => !!state.token,
    },

    actions: {
        async login(credentials) {
            this.loading = true;
            this.error = null;
            try {
                const response = await axios.post("/api/v1/login", credentials);
                const { token, user } = response.data;

                this.token = token;
                this.user = user;

                // Stocker le token dans le localStorage
                localStorage.setItem("token", token);

                // Configurer axios pour utiliser le token
                axios.defaults.headers.common[
                    "Authorization"
                ] = `Bearer ${token}`;

                return true;
            } catch (error) {
                this.error =
                    error.response?.data?.message ||
                    "Une erreur est survenue lors de la connexion";
                return false;
            } finally {
                this.loading = false;
            }
        },

        async logout() {
            try {
                await axios.post("/api/v1/logout");
            } catch (error) {
                console.error("Erreur lors de la déconnexion:", error);
            } finally {
                this.token = null;
                this.user = null;
                localStorage.removeItem("token");
                delete axios.defaults.headers.common["Authorization"];
            }
        },

        async checkAuth() {
            if (!this.token) return false;

            try {
                const response = await axios.get("/api/v1/user");
                this.user = response.data;
                return true;
            } catch (error) {
                this.token = null;
                this.user = null;
                localStorage.removeItem("token");
                delete axios.defaults.headers.common["Authorization"];
                return false;
            }
        },
    },
});
