<template>
    <nav class="conatiner-fluid text-bg-success">
        <div
            class="container d-flex text-uppercase justify-content-center align-items-center p-3"
        >
            <NuxtLink class="text-warning text-decoration-none m-2" to="/"
                >Биржа микрозаданий</NuxtLink
            >
            <NuxtLink class="text-white text-decoration-none m-2" to="#"
                >Правила</NuxtLink
            >
            <NuxtLink class="text-white text-decoration-none m-2" to="#"
                >Вопросы</NuxtLink
            >
            <NuxtLink class="text-white text-decoration-none m-2" to="#"
                >Новости</NuxtLink
            >
            <NuxtLink class="text-white text-decoration-none m-2" to="#"
                >Тарифы</NuxtLink
            >
            <NuxtLink class="text-white text-decoration-none m-2" to="#"
                >Контакты</NuxtLink
            >
            <NuxtLink class="text-dark text-decoration-none m-2" to="/signup"
                >Регистрация</NuxtLink
            >
            <NuxtLink class="text-dark text-decoration-none m-2" to="/login"
                >Вход</NuxtLink
            >
        </div>
    </nav>
</template>

<style>
.nav {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    padding: 0 2rem;
    height: 60px;
    display: flex;
    align-items: center;
    background: darkred;
    color: #fff;
}
</style>
