import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../components/views/HomeView.vue";
import LoginView from "../components/views/LoginView.vue";
import RegisterView from "../components/views/RegisterView.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: HomeView,
        meta: { requiresAuth: true },
    },
    {
        path: "/login",
        name: "login",
        component: LoginView,
    },
    {
        path: "/register",
        name: "register",
        component: RegisterView,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem("token");
    if (
        to.matched.some((record) => record.meta.requiresAuth) &&
        !isAuthenticated
    ) {
        next("/login");
    } else {
        next();
    }
});
export default router;
