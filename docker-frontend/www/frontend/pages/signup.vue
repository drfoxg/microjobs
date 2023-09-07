<script lang="ts" setup>
import { useAuthStore } from "~/stores/useAuthStore";

definePageMeta({
    layout: "loginregister",
    middleware: ["guest"],
});

useHead({
    bodyAttrs: {
        class: "text-center",
    },
});

const form = ref({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const auth = useAuthStore();

async function handelSignup() {
    if (auth.isLoggedIn) {
        navigateTo("/select-role");
    }

    const { error } = await auth.signup(form.value);
    console.log(error);

    if (!error.value) {
        navigateTo("/");
    }
}
</script>

<template>
    <div
        class="container d-flex justify-content-center align-items-center h-100"
    >
        <form class="form-signin" @submit.prevent="handelSignup">
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
                    name="name"
                    type="text"
                    class="form-control"
                    id="floatingInputName"
                    placeholder="Иванов Иван Иванович"
                    v-model="form.name"
                />
                <label for="floatingInputName">Ваше имя</label>
            </div>
            <div class="form-floating">
                <input
                    name="email"
                    type="email"
                    class="form-control form-control-email-in-center"
                    id="floatingInput"
                    placeholder="name@example.com"
                    v-model="form.email"
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
                    v-model="form.password"
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
                    v-model="form.password_confirmation"
                />
                <label for="floatingPasswordRepeat">Повторите пароль</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input name="i_agree" type="checkbox" value="i_agree" />
                    Принять правила обработки персональных данных
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

<style scoped></style>
