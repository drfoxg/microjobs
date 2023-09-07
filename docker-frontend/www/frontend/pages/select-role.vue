<script lang="ts" setup>
import { definePageMeta } from "#imports";

definePageMeta({
    layout: "loginregister",
    middleware: ["auth"],
});
</script>

<template>
    <div class="container fs-5 p-3">
        Вы можете быть одновременно автором и заказчиком. Для перехода между
        кабинетами нажмите на логин справа вверху и воспользуйтесь
        переключателем.
    </div>
</template>

<style scoped></style>
