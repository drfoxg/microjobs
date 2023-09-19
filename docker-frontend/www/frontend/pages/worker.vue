<script lang="ts" setup>
import { definePageMeta } from "#imports";
import { useUserRoleStore } from "~/stores/useUserRoleStore";
import { useAuthStore } from "~/stores/useAuthStore";

definePageMeta({
    layout: "loginregister",
    middleware: ["auth"],
});

const key: string = 'worker';

//let filteredList;
/*
const refreshing = ref(false);
const key = 'rows';

async function refreshAll()
{
    refreshing.value = true
    try {
        await refreshNuxtData()
    } finally {
        refreshing.value = false
    }
}
*/

const whoAmI = useWhoami();
const auth = useAuthStore();
const userRole = useUserRoleStore();

let userId: number = auth.user.id;
let url: string = `/api/job?not_worker_id=${userId}`;

async function handelMyWorks() {
    navigateTo("/mywork");
}

async function handelTakeToWork(event) {
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
        'worker_id': `${userId}`,
        'job_state_id': '2',
    });
    
    const { pending, data: filteredList, error, status, refresh } = await useApiFetchPut(url, xWwwFormUrlencoded, { method: "PUT" }, 'worker-put');    

    refreshNuxtData(key);

    console.log("filteredList:", filteredList.data);
}

console.log(userRole.roleName);
console.log(whoAmI);

const { pending, data: filteredList, error, status, refresh, response } = await useApiFetch(url, {}, key);

console.log("error: " + error.value);
console.log("statusCode: " + status.value);
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
        <h1>
            <!-- Задания пользователя {{ userRole.roleName }} : {{ userRole.role }} -->
            Проекты
        </h1>
        ВНИМАНИЕ!<br>
        В данный момент Вам доступен заработок на лайках, репостах и подписках.<br>
        Для доступа к написанию комментариев Вам необходимо сдать экзамен.<br>
        <br>
        <button class="btn btn-primary mb-3 fs-5 employer-button" @click="handelMyWorks">
            Мои работы
        </button>
        <div v-if="!filteredList">
            Задания не найдены
        </div>
        <div v-else>
            <div v-if="pending">
                Загрузка ...
            </div>
            <div v-else class="list-view">
                <div v-for="item in filteredList.data" class="row">
                    <div class="id-title d-flex flex-column w-50 p-0 mb-3">
                        <div class="caption text-white bg-success bg-gradient">
                            <div class="header-text p-2">
                                <span class="ms-1">{{ item.id }}</span> 
                            </div>
                        </div>
                        <div class="content p-2">
                            {{ item.title }} 
                        </div>
                    </div>
                    <div class="cost d-flex flex-column w-25 text-center bg-white p-0 mb-3">
                        <div class="caption text-white bg-success bg-gradient">
                            <div class="header-text p-2">Цена</div>
                        </div>
                        <div class="content p-2">
                            {{ item.cost }} {{ item.currency_name }} 
                        </div>
                    </div>
                    <div class="action d-flex flex-column w-25 text-center bg-white p-0 mb-3">
                        <div class="caption text-white bg-success bg-gradient">
                            <div class="header-text p-2">Действия</div>
                        </div>
                        <div class="content p-2">
                            <button class="btn btn-info mb-1" @click="handelTakeToWork" :data-id="item.id">Взять в работу</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
