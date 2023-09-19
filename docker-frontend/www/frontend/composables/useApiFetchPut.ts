import type { UseFetchOptions } from "nuxt/app";

export function useApiFetchPut<T>(path: string,  formData: URLSearchParams, options: UseFetchOptions<T> = {}, refreshKey?: string) {
    let headers: any = {
        accept: "application/json",
        referer: "http://sulphur.fun",
        "Cache-Control": "no-cache",
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

    console.log(formData);


    return useFetch("http://sulphur.fun:9777" + path, {
        key: refreshKey,
        body: formData,
        credentials: "include",
        watch: false,
        ...options,
        headers: {
            ...headers,
            ...options?.headers,
        },
        onResponse({request, response, options}) {

            console.log("status:" + response.status);

            if (response.status === 204) {
                console.log("status 204 is fire");
            }
        },
        onResponseError({request, response, options}) {
            
            console.log("status:" + response.status);            

            if (response.status === 404) {
                console.log("status 404 is fire");
            } else {
                //your code
            }
            //router.push("/")
        },
    });
}
