<template>
    <div
        class="container d-flex justify-content-center align-items-center py-3"
    >
        <span class="m-1"
            ><font-awesome-icon :icon="['far', 'copyright']" /></span
        >Все права защищены
        <span class="m-1"
            ><font-awesome-icon :icon="['fas', 'envelope']" /></span
        ><NuxtLink
            to="mailto:help@sulphur.fun"
            class="text-decoration-none text-white"
            >help@sulphur.fun</NuxtLink
        >
    </div>
</template>