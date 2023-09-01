<template>
    <div class="row p-1 first-block justify-content-end align-items-center">
        <div class="col-xl-6">
            <div class="d-flex flex-column">
                <div
                    class="border border-dark border-3 text-uppercase fs-2 fw-bold p-3"
                >
                    Биржа комментариев и социального продвижения
                </div>

                <div class="fs-5 p-3">
                    <span class="text-bg-success text-warning fw-medium p-1"
                        >Биржа микрозаданий</span
                    >
                    предоставляет инструмент по крауд-маркетингу для пиара и
                    продвижения в интернете. Продвигайте бренды, группы в
                    социальных сетях, видео на youtube, поднимайте репутацию в
                    интернете с помощью комментариев и отзывов.

                    <!-- Button trigger js modal -->
                    <div class="pt-3">
                        <button
                            type="button"
                            class="btn btn-primary w-50"
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModal"
                        >
                            Начать работу
                        </button>
                    </div>
                </div>

                <!-- Modal -->
                <div
                    class="modal fade"
                    id="exampleModal"
                    tabindex="-1"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true"
                >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Modal title
                                </h5>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>
                            <div class="modal-body">
                                I am bootstrap modal using JS!
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                >
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!--  Example how you could render api data -->
                <!--  <div v-for="video in videos.data">-->
                <!--    <nuxt-link to="/">-->
                <!--      Title-->
                <!--    </nuxt-link>-->
                <!--  </div>-->
            </div>
        </div>
    </div>
</template>
  
<script setup>
// load your data, for example:
// const {data: videos} = await useFetch('http://localhost:1337/api/videos')
</script>

<style scoped>
.first-block {
    height: 450px;
}
</style>
