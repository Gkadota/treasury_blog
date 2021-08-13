<template>
    <div>
        <div class="columns">
            <div class="column is-two-fifths peru">

                <div id="home-desc" class="container ">
                    <h1 id="welcome-title" class="title"> WELCOME !</h1>

                    <p class="sub-title">
                        Weekly blog articles about FINANCE, TECHNOLOGY, and BUSINESS. Register today to never miss a post!
                    </p>

                    <router-link class="reg-btn button is-warning is-rounded" :to="{ name: 'register' }">REGISTER NOW!</router-link>
                </div>
            </div>

            <div class="column home-bg">
            </div>
        </div>
    </div>
</template>

<script>
 export default {
        name: 'Home'
}
</script>

<style  scoped>
    .home-bg {
    background-size: cover;
    background-image: url(../assets/home.jpg);
    width: 100%;
    height: 100vh;
    }

    .peru {
        background: peru;
    }

    #home-desc {
        text-align: center;
        padding: 187px 40px;
        color:#fff !important;
    }

    #welcome-title {
        color:#fff !important;
    }

    .reg-btn {
        margin-top: 30px;
    }


</style>
