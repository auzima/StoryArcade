import { createRouter, createWebHistory } from "vue-router";
import HomePage from "./components/HomePage.vue";
import SceneList from "./components/SceneList.vue";
import ScenePage from "./components/ScenePage.vue";

const routes = [
    {
        path: "/",
        component: HomePage,
        name: "home",
    },
    {
        path: "/play",
        component: SceneList,
        name: "play.index",
    },
    {
        path: "/play/:id",
        component: ScenePage,
        name: "scene",
        props: true,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
