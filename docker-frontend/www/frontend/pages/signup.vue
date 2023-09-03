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
            <h1 class="h3 mb-3 fw-normal">Пожалуйста, зарегистрируйтесь</h1>

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
                    class="form-control form-control-in-center"
                    id="floatingPassword"
                    placeholder="Пароль"
                />
                <label for="floatingPassword">Пароль</label>
            </div>
            <div class="form-floating">
                <input
                    name="password-repeat"
                    type="password"
                    class="form-control"
                    id="floatingPasswordRepeat"
                    placeholder="Повторите пароль"
                />
                <label for="floatingPasswordRepeat">Повторите пароль</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input name="i_agree" type="checkbox" value="i_agree" />
                    Согласен с правилами обработки персональных данных
                </label>
            </div>
            <button
                name="sing_in"
                class="w-100 btn btn-lg btn-primary"
                type="submit"
            >
                Регистрация
            </button>
            <NuxtLink class="d-block text-decoration-none p-3" to="/login"
                >Вход</NuxtLink
            >
        </form>
    </div>
</template>

<script>
export default {};
</script>

<style scoped></style>
