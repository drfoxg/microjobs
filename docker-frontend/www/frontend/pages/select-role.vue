<script lang="ts" setup>
import { definePageMeta } from "#imports";
import { role as Role } from "#imports";
import { useUserRoleStore } from "~/stores/useUserRoleStore";

definePageMeta({
    layout: "loginregister",
    middleware: ["auth"],
});

const whoAmI = useWhoami();

const userRole = useUserRoleStore();

async function handelEmployer() {
    userRole.roleName = "Employer";
    userRole.role = Role.Employer;
    navigateTo("/employer");
}

async function handelWorker() {
    userRole.roleName = "Worker";
    userRole.role = Role.Worker;
    navigateTo("/worker");
}
</script>

<template>
    <div class="container fs-5 p-3">
        Вы можете быть одновременно автором и заказчиком. Для перехода между
        кабинетами нажмите на логин справа вверху и воспользуйтесь
        переключателем.
        <div class="row mt-3">
            <div class="col-6 d-flex justify-content-center">
                <button
                    class="btn btn-primary mb-3 fs-3 employer-button"
                    @click="handelEmployer"
                >
                    Заказчик
                </button>
            </div>
            <div class="col-6 d-flex justify-content-center">
                <button
                    class="btn btn-primary mb-3 fs-3 worker-button"
                    @click="handelWorker"
                >
                    Автор
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
