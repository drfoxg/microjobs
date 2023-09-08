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
    <div class="d-flex flex-column h-100 loginregister">
        <TheNavigation />
        <button class="mt-1 mb-1" v-if="auth.isLoggedIn" @click="handleLogout">
            Выход(Logout)
        </button>
        <button class="mb-1" v-if="auth.isLoggedIn" @click="handleDashborad">
            Панель управления(Dashboard)
        </button>
        <div class="container">
            Пользователь:
            <pre>{{ auth.user }}</pre>
        </div>
        <slot />
        <TheFooter />
    </div>
</template>

<style scoped></style>
