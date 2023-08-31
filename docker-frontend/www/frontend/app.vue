<script setup lang="ts">
useHead({
    htmlAttrs: {
        class: "h-100",
    },
    bodyAttrs: {
        class: "h-100",
    },
});
</script>

<template>
    <TheNavigation />

    <!-- 
        <div class="bg-theme1 p-3">
            <h1 class="text-white d-inline-block">
                Ready to build something awesome!&nbsp;
            </h1>
            <div class="spinner-border text-white" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        -->
    <!-- Markup shared across all pages, ex: NavBar -->
    <NuxtLayout>
        <NuxtPage />
    </NuxtLayout>
    <TheFooter />
</template>

<style>
</style>