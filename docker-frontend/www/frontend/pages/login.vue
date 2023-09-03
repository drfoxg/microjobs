<script setup>
definePageMeta({
    layout: "loginregister",
});

useHead({
    bodyAttrs: {
        class: "text-center",
    },
});
</script>

<template>
    <div
        class="container d-flex justify-content-center align-items-center h-100"
    >
        <form class="form-signin">
            <img
                class="mb-4"
                src="~/assets/img/iam.svg"
                alt=""
                width="50"
                height="50"
            />
            <h1 class="h3 mb-3 fw-normal">Пожалуйста, авторизуйтесь</h1>

            <div class="form-floating">
                <input
                    name="email"
                    type="email"
                    class="form-control"
                    id="floatingInput"
                    placeholder="name@example.com"
                />
                <label for="floatingInput">Ваш e-mail</label>
            </div>
            <div class="form-floating">
                <input
                    name="password"
                    type="password"
                    class="form-control"
                    id="floatingPassword"
                    placeholder="Password"
                />
                <label for="floatingPassword">Пароль</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input
                        name="remember-me"
                        type="checkbox"
                        value="remember-me"
                    />
                    Запомнить меня
                </label>
            </div>
            <button
                name="sing_in"
                class="w-100 btn btn-lg btn-primary"
                type="submit"
            >
                Вход
            </button>
            <NuxtLink class="d-block text-decoration-none p-3" to="/signup"
                >Регистрация</NuxtLink
            >
        </form>
    </div>
</template>

<script>
export default {};
</script>

<style scoped></style>
