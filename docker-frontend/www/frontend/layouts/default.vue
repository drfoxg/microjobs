<template>
    <!-- <main class="container-fluid flex-shrink-0 default"> -->
    <main class="flex-shrink-0">
        <div class="container">
            Some default layout shared across all pages
            <slot />
        </div>
    </main>
</template>

<style scoped>
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