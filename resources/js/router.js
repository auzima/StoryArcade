import { createRouter, createWebHistory } from "vue-router";
import Home from "./pages/Home.vue";
import GamesList from "./pages/GamesList.vue";
import GamePlay from "./pages/GamePlay.vue";

const routes = [
    {
        path: "/",
        component: Home,
        name: "home",
    },
    {
        path: "/play",
        component: GamesList,
        name: "games.list",
    },
    {
        path: "/games/:id/play",
        component: GamePlay,
        name: "games.play",
        props: true,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
