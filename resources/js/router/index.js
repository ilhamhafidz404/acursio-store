import { createRouter, createWebHistory } from "vue-router";

const routes = [
    // {
    //     path: "/test",
    //     name: "Home",
    //     component: () => import("@/pages/Home.vue"),
    // },
    // {
    //     path: "/jockey-service",
    //     name: "JockeyService",
    //     component: () => import("@/pages/JockeyService.vue"),
    // },
    //
    {
        path: "/payment-finish",
        name: "PaymentFinish",
        component: () => import("@/pages/Payment/Finish.vue"),
    },
    {
        path: "/payment-unfinish",
        name: "PaymentUnfinish",
        component: () => import("@/pages/Payment/Unfinish.vue"),
    },
    {
        path: "/payment-error",
        name: "PaymentError",
        component: () => import("@/pages/Payment/Error.vue"),
    },
    //
    {
        path: "/",
        name: "AccountStore",
        component: () => import("@/pages/AccountStore/Index.vue"),
    },
    // {
    //     path: "/account-store",
    //     name: "AccountStore",
    //     component: () => import("@/pages/AccountStore/Index.vue"),
    // },
    {
        path: "/account-store/:id",
        name: "AccountStoreDetail",
        component: () => import("@/pages/AccountStore/Detail.vue"),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
