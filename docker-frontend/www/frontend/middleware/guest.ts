import { useAuthStore } from "~/stores/useAuthStore";

export default defineNuxtRouteMiddleware((to, from) => {
    const auth = useAuthStore();

    if (auth.isLoggedIn) {
        // place in the browser history
        return navigateTo("/", { replace: true });
    }
});
