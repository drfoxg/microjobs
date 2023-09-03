<template>
    <div class="d-flex flex-column h-100">
        <TheNavigation />
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
