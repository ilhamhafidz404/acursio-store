import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        name: "Home",
        component: () => import("@/pages/Home.vue"),
    },
    {
        path: "/account-store",
        name: "AccountStore",
        component: () => import("@/pages/AccountStore.vue"),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
