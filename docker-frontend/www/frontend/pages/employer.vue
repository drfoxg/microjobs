<script lang="ts" setup>
import { definePageMeta } from "#imports";
import { useUserRoleStore } from "~/stores/useUserRoleStore";
import { useAuthStore } from "~/stores/useAuthStore";

definePageMeta({
    layout: "loginregister",
    middleware: ["auth"],
});

const auth = useAuthStore();
const userRole = useUserRoleStore();

const key: string = 'employer';

let userId: number = auth.user.id;
let url: string = `/api/job?employer_id=${userId}`;

async function handelEmployer() {
    navigateTo("/new-project");
}

async function handelToDenyWork(event) {
    let id = parseInt(event.target.getAttribute('data-id'));

    let url: string = `/api/job/${id}`;

    if (Number.isNaN(id)) {
        console.log("Error! NaN");
    } else {
        console.log("Ok:" + id);
    }

    console.log("id:" + id);
    console.log("userId:" + userId);

    let xWwwFormUrlencoded = new URLSearchParams({
        '_method': 'PUT',
        'employer_id': `${userId}`,
        'job_state_id': '4',
    });
    
    const { pending, data: filteredList, error, status, refresh } = await useApiFetchPut(url, xWwwFormUrlencoded, { method: "PUT" }, 'worker-put');    

    refreshNuxtData(key);

    console.log("filteredList:", filteredList.data);
}

async function handelToAcceptWork(event) {
    let id = parseInt(event.target.getAttribute('data-id'));

    let url: string = `/api/job/${id}`;

    if (Number.isNaN(id)) {
        console.log("Error! NaN");
    } else {
        console.log("Ok:" + id);
    }

    console.log("id:" + id);
    console.log("userId:" + userId);

    let xWwwFormUrlencoded = new URLSearchParams({
        '_method': 'PUT',
        'employer_id': `${userId}`,
        'job_state_id': '5',
    });
    
    const { pending, data: filteredList, error, status, refresh } = await useApiFetchPut(url, xWwwFormUrlencoded, { method: "PUT" }, 'worker-put');    

    refreshNuxtData(key);

    console.log("filteredList:", filteredList.data);
}

console.log(userRole.roleName);

const { pending, data: filteredList, error, status, refresh  } = await useApiFetch(url, {}, key);

console.log("error:" + error.value);
console.log("data: ", filteredList);
console.log("data: ", filteredList.value);

const fields = [
    "id",
    "title",
    "cost",
    "currency_iso",
    "currency_name",
    "job_state_id",
    "employer_has_worker_employer_id",
    "employer_has_worker_worker_id",
];

</script>

<template>
    <div class="container fs-5 p-3">
        <h1>Мои задания {{ userRole.roleName }} : {{ userRole.role }}</h1>
        <button class="btn btn-success mb-3 fs-5 employer-button" @click="handelEmployer">
            Создать задание
        </button>
        <!--
        <div>
            <table
                id="tableComponent"
                class="table table-bordered table-striped"
            >
                <thead>
                    <tr>
                        <th
                            v-for="field in fields"
                            :key="field"
                        >
                            {{ field }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="item in filteredList"
                        :key="item"
                    >
                        <td
                            v-for="field in fields"
                            :key="field"
                        >
                            {{ item[field] }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        -->
        <div v-if="!filteredList">
            Задания не найдены
        </div>
        <div v-else>
            <div v-if="pending">
                Загрузка ...
            </div>
            <div v-else class="list-view">
                <div v-for="item in filteredList.data" class="row">
                    <!-- {{ filteredList }} -->
                    <div class="id-title d-flex flex-column w-25 p-0 mb-3">
                        <div class="caption text-white bg-secondary bg-gradient">
                            <div class="header-text p-2">
                                ID <span class="ms-1">{{ item.id }}</span>
                            </div>
                        </div>
                        <div class="content p-2">
                            {{ item.title }}
                        </div>
                    </div>
                    <div class="job-state d-flex flex-column w-25 text-center bg-white p-0 mb-3">
                        <div class="caption text-white bg-secondary bg-gradient">
                            <div class="header-text p-2">Статус</div>
                        </div>
                        <div class="content p-2">
                            {{ item.job_state.name }}
                        </div>
                    </div>
                    <div class="cost d-flex flex-column w-25 text-center bg-white p-0 mb-3">
                        <div class="caption text-white bg-secondary bg-gradient">
                            <div class="header-text p-2">Цена</div>
                        </div>
                        <div class="content p-2">
                            {{ item.cost }} {{ item.currency_name }}
                        </div>
                    </div>
                    <div class="action d-flex flex-column w-25 text-center bg-white p-0 mb-3">
                        <div class="caption text-white bg-secondary bg-gradient">
                            <div class="header-text p-2">Действия</div>
                        </div>
                        <div class="content p-2 d-grid gap-2">
                            <button v-if="item.job_state.id == 1" class="btn btn-outline-info mb-1">Оплатить</button>
                            <button v-if="item.job_state.id == 3" class="btn btn-outline-info mb-1" @click="handelToAcceptWork" :data-id="item.id">Принять</button>
                            <button v-if="item.job_state.id == 3" class="btn btn-outline-info mb-1" @click="handelToDenyWork" :data-id="item.id" >Отклонить</button>
                            <button v-if="item.job_state.id == 5" class="btn btn-outline-info mb-1">Повторить</button>
                            <button v-if="item.job_state.id == 4 || item.job_state.id == 5" class="btn btn-outline-info mb-1">В архив</button>
                            <button v-if="item.job_state.id == 6" class="btn btn-outline-info mb-1">Вернуть в работу</button>
                            <button v-if="item.job_state.id == 6" class="btn btn-outline-info mb-1">Пожаловаться</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
