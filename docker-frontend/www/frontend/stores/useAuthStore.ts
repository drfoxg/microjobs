import { defineStore } from "pinia";

type User = {
    id: number;
    name: string;
    email: string;
};

type Credential = {
    email: string;
    password: string;
};

type SignupInfo = {
    name: string;
    email: string;
    password: string;
    password_repeat: string;
};

export const useAuthStore = defineStore("auth", () => {
    const user = ref<User | null>(null);

    const isLoggedIn = computed(() => !!user.value);

    async function logout() {
        await useApiFetch("/logout", { method: "POST" });
        user.value = null;
        navigateTo("/");
    }

    async function fetchUser() {
        const { data, error } = await useApiFetch("/api/user");

        console.log(error.value);
        user.value = data.value as User;
        console.log(data);
    }

    async function login(credentials: Credential) {
        await useApiFetch("/sanctum/csrf-cookie", {
            credentials: "include",
        });

        const login = await useApiFetch("/login", {
            method: "POST",
            body: credentials,
        });

        await fetchUser();

        return login;
    }

    async function signup(info: SignupInfo) {
        await useApiFetch("/sanctum/csrf-cookie", {
            credentials: "include",
        });

        const singup = await useApiFetch("/register", {
            method: "POST",
            body: info,
        });

        await fetchUser();

        return signup;
    }

    return { user, isLoggedIn, fetchUser, login, logout, signup };
});
