import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/Home.vue";
import GamesList from "../pages/GamesList.vue";
import GamePlay from "../pages/GamePlay.vue";
import { useAuthStore } from "../stores/auth";

const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
    },
    {
        path: "/play",
        name: "games.list",
        component: GamesList,
    },
    {
        path: "/games/:id/play",
        name: "games.play",
        component: GamePlay,
        props: true,
    },
    {
        path: "/login",
        name: "login",
        component: () => import("../pages/Login.vue"),
        meta: { guest: true },
    },
    {
        path: "/admin",
        name: "admin",
        component: () => import("../pages/Admin.vue"),
        meta: { requiresAuth: true },
    },
    {
        path: "/:pathMatch(.*)*",
        redirect: "/",
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { top: 0 };
        }
    },
});

// Navigation guard
router.beforeEach(async (to, from, next) => {
    const authStore = useAuthStore();
    const isAuthenticated = await authStore.checkAuth();

    if (to.meta.requiresAuth && !isAuthenticated) {
        next({ name: "login" });
    } else if (to.meta.guest && isAuthenticated) {
        next({ name: "admin" });
    } else {
        next();
    }
});

export default router;
