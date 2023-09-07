import { useAuthStore } from "~/stores/useAuthStore"

export default defineNuxtPlugin(({ $pinia }) => {
    return {
        provide: {
            store: useAuthStore($pinia)
        }
    }
})