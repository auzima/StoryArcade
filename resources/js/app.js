import "./bootstrap";
import { createApp } from "vue";
import { createPinia } from "pinia";
import App from "./App.vue";
import router from "./router";

// Créer l'instance de l'application
const app = createApp(App);

// Configurer Pinia pour la gestion d'état
const pinia = createPinia();
app.use(pinia);

// Configurer le routeur
app.use(router);

// Gestion des erreurs de route
router.onError((error) => {
    console.error("Erreur de routage:", error);
});

// Monter l'application
app.mount("#app");
