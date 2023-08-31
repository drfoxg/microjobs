<template>
    <div>
        <h2>I am loaded from a page!</h2>
        <h2>Тест русского</h2>

        <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iure
            itaque commodi voluptatibus consequatur maiores assumenda harum
            blanditiis, saepe explicabo rerum odio aut, quod veritatis id quam
            unde ullam maxime reiciendis beatae eius vitae deleniti minus
            ratione? Quidem obcaecati odit perferendis asperiores officia iusto
            reiciendis nihil omnis delectus corporis ducimus maiores vero non
            ea, saepe, aut molestias quis quasi impedit! Officia excepturi
            doloribus veritatis adipisci rerum cupiditate illum accusantium ad
            necessitatibus. Libero eum reiciendis nisi voluptatibus fuga
            quibusdam labore odio debitis, illum id totam eius aliquid tempore
            commodi itaque voluptatum? Autem odit molestias optio quasi modi
            minus ullam eius consequuntur cupiditate?
        </p>

        <!-- Button trigger js modal -->
        <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
        >
            Launch demo modal
        </button>

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
                    <div class="modal-body">I am bootstrap modal using JS!</div>
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
</template>
  
  <script setup>
// load your data, for example:
// const {data: videos} = await useFetch('http://localhost:1337/api/videos')
</script>