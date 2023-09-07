import type { UseFetchOptions } from "nuxt/app";

export function useApiFetch<T>(path: string, options: UseFetchOptions<T> = {}) {
    let headers: any = {
        accept: "application/json",
        referer: "http://sulphur.fun",
    };

    const token = useCookie("XSRF-TOKEN");

    if (token.value) {
        headers["X-XSRF-TOKEN"] = token.value as string;
    }

    if (process.server) {
        headers = {
            ...headers,
            ...useRequestHeaders(["cookie"]),
            referer: "http://sulphur.fun",
        };
    }

    return useFetch("http://sulphur.fun:9777" + path, {
        credentials: "include",
        watch: false,
        ...options,
        headers: {
            ...headers,
            ...options?.headers,
        },
    });
}
