<script setup>
import { definePageMeta } from "#imports";
import { useUserRoleStore } from "~/stores/useUserRoleStore";
import { useAuthStore } from "~/stores/useAuthStore";

definePageMeta({
    layout: "loginregister",
    middleware: ["auth"],
});

const auth = useAuthStore();
const userRole = useUserRoleStore();

</script>

<template>
    <div class="container fs-5 p-3">
        <h1>Создать задание {{ userRole.roleName }} : {{ userRole.role }}</h1>
    </div>
</template>

<style lang="scss" scoped>

</style>