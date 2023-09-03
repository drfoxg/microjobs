// get from https://github.com/maxvanweenen/Nuxt-3-bootstrap-5-starter
// this string not work
// import { defineNuxtConfig } from 'nuxt'

export default defineNuxtConfig({
    // My Nuxt config
    site: {
        url: "http://sulphur.fun",
    },

    modules: ["nuxt-simple-robots"],

    plugins: [{ src: "~/plugins/fontawesome.ts" }],

    css: [
        "~/assets/scss/main.scss",
        "@fortawesome/fontawesome-svg-core/styles.css",
    ],
});
