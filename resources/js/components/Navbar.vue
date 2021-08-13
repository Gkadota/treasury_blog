<template>
    <b-navbar type="is-light">
        <template #brand>
            <b-navbar-item  tag="router-link" :to="{ name: 'home' }">
                <p id="logo">TBLOGS</p>
            </b-navbar-item>
        </template>

        <template #end>
            <b-navbar-item tag="div">
                <div class="buttons">
                    <router-link class="button is-primary" :to="{ name: 'blogs' }">Blogs</router-link>
                    <router-link class="button is-primary" :to="{ name: 'login' }">Login</router-link>
                    <router-link class="button is-light" :to="{ name: 'register' }">Register</router-link>
                </div>
            </b-navbar-item>
        </template>
    </b-navbar>
</template>

<script>
export default {

}
</script>

<style>
    #logo {
        color: peru;
        font-size: 25px;
        font-weight: 900;
        font-family: Quicksand,sans-serif;

    }
</style>
