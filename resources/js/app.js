import './bootstrap';
import { createApp } from 'vue';
import SceneChoices from './components/SceneChoices.vue';
import ThemeToggle from './components/ThemeToggle.vue';

// Créer l'application Vue
const app = createApp({});

// Enregistrer les composants globaux
app.component('scene-choices', SceneChoices);
app.component('theme-toggle', ThemeToggle);

// Monter l'application sur un seul élément avec #vue-app
const mountPoint = document.getElementById('vue-app');
if (mountPoint) {
    app.mount('#vue-app');
}