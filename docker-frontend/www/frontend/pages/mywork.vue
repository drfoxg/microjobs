<script lang="ts" setup>
import { definePageMeta } from "#imports";
import { useUserRoleStore } from "~/stores/useUserRoleStore";
import { useAuthStore } from "~/stores/useAuthStore";

definePageMeta({
    layout: "loginregister",
    middleware: ["auth"],
});

const key: string = 'myworker';

const whoAmI = useWhoami();
const auth = useAuthStore();
const userRole = useUserRoleStore();
console.log(userRole.roleName);
console.log(whoAmI);

let userId: number = auth.user.id;
let url: string = `/api/job?worker_id=${userId}`;

async function handelToCheckhWork(event) {
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
        'job_state_id': '3',
    });
    
    const { pending, data: filteredList, error, status, refresh } = await useApiFetchPut(url, xWwwFormUrlencoded, { method: "PUT" }, 'worker-put');    

    refreshNuxtData(key);

    //filteredList = JSON.parse(data.value.toString()).data;
    //filteredList = data.value;
    console.log("filteredList:", filteredList.data);
}

async function handelToReturnWork(event) {
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
        'job_state_id': '6',
    });
    
    const { pending, data: filteredList, error, status, refresh } = await useApiFetchPut(url, xWwwFormUrlencoded, { method: "PUT" }, 'worker-put');    

    refreshNuxtData(key);

    //filteredList = JSON.parse(data.value.toString()).data;
    //filteredList = data.value;
    console.log("filteredList:", filteredList.data);
}

const { pending, data: filteredList, error, status, refresh } = await useApiFetch(url, {}, key);
const errorStatus = useError();

console.log("error:" + error.value);
console.log("statusCode:" + error?.status );
console.log("data: ", filteredList);
console.log("data: ", filteredList.data);

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
            Задания пользователя {{ userRole.roleName }} : {{ userRole.role }}            
        </h1>
        
        <br>
        <div v-if="!filteredList">
            Работы не найдены
        </div>
        <div v-else>
            <div v-if="pending">
                Загрузка ...
            </div>
            <div v-else class="list-view">
                <div v-for="item in filteredList.data" class="row">
                    <!-- {{ filteredList }} -->
                    <div class="id-title d-flex flex-column w-25 p-0 mb-3">
                        <div class="caption text-white bg-success bg-gradient">
                            <div class="header-text p-2">
                                ID <span class="ms-1">{{ item.id }}</span>
                            </div>
                        </div>
                        <div class="content p-2">
                            {{ item.title }}
                        </div>
                    </div>
                    <div class="job-state d-flex flex-column w-25 text-center bg-white p-0 mb-3">
                        <div class="caption text-white bg-success bg-gradient">
                            <div class="header-text p-2">Статус</div>
                        </div>
                        <div v-if="item.job_state.id == 4" class="content text-danger p-2">
                            {{ item.job_state.name }}
                        </div>
                        <div v-else-if="item.job_state.id ==5" class="content text-success p-2">
                            {{ item.job_state.name }}
                        </div>
                        <div v-else class="content p-2">
                            {{ item.job_state.name }}
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
                        <div class="content p-2 d-grid gap-2">
                            <button v-if="item.job_state.id == 2" class="btn btn-outline-info mb-1" @click="handelToCheckhWork" :data-id="item.id">Сдать задание</button>
                            <button v-if="item.job_state.id == 4" class="btn btn-outline-info mb-1" :data-id="item.id">В архив</button>
                            <button v-if="item.job_state.id == 5" class="btn btn-outline-info mb-1" :data-id="item.id">В архив</button>
                            
                            <button v-if="item.job_state.id != 4 && item.job_state.id != 5" class="btn btn-outline-info mb-1" @click="handelToReturnWork" :data-id="item.id">Отказаться от задания</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
