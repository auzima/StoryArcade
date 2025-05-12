import "./bootstrap";
import { createApp } from "vue";
import { route } from "ziggy-js";
import App from "./App.vue";

import SceneChoices from "./components/SceneChoices.vue";
import HomePage from "./components/HomePage.vue";
import GamesPage from "./pages/GamesPage.vue";
import GamesList from "./components/GamesList.vue";

// Créer une seule instance de l'application Vue
const app = createApp(App);

// Rendre la fonction route disponible globalement
app.config.globalProperties.$route = route;

// Enregistrer tous les composants globaux
app.component("scene-choices", SceneChoices);
app.component("home-page", HomePage);
app.component("games-page", GamesPage);

// Montage du composant GamesList
const gamesList = createApp(GamesList);
gamesList.mount("#games-list");

// Monter l'application sur #vue-app s'il existe
const mountVueApp = document.getElementById("vue-app");
if (mountVueApp) {
    app.mount("#vue-app");
}

// Sinon, monter sur #app (ex. pour la page d'accueil)
const mountApp = document.getElementById("app");
if (mountApp) {
    app.mount("#app");
}
