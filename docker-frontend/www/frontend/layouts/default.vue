<script lang="ts" setup>
import { useAuthStore } from "~/stores/useAuthStore";

const auth = useAuthStore();

async function handleLogout() {
    await auth.logout();
}

async function handleDashborad() {
    navigateTo("/select-role");
}
</script>

<template>
    <div class="d-flex flex-column h-100">
        <TheNavigation />
        <button class="mt-1 mb-1" v-if="auth.isLoggedIn" @click="handleLogout">
            Выход
        </button>
        <button class="mb-1" v-if="auth.isLoggedIn" @click="handleDashborad">
            Панель управления
        </button>
        <div class="container">
            Пользователь:
            <pre>{{ auth.user }}</pre>
        </div>
        <main class="flex-shrink-0 main-background">
            <div class="container container-img">
                <slot />
            </div>
        </main>
        <TheMainSecondBlock />
        <TheMainThirdBlock />
        <TheFooter />
    </div>
</template>

<style scoped>
.main-background {
    background-color: #b8e39e87;
    height: 450px;
}

.container-img {
    background: url(~/assets/img/typo.png) no-repeat left 50%;
}
.default {
    border: 1px solid #b9e39e;
    padding: 1rem;
    position: relative;
    background-color: #b8e39e87;
}
.default::before {
    content: "layouts/default.vue";
    position: absolute;
    top: 2px;
    left: 5px;
    color: #68b538;
    font-family: monospace;
}
</style>
