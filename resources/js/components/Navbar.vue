<template>
    <b-navbar type="is-light">
        <template #brand>
            <b-navbar-item  tag="router-link" :to="{ name: 'home' }">
                <img
                    src="https://raw.githubusercontent.com/buefy/buefy/dev/static/img/buefy-logo.png"
                    alt="Lightweight UI components for Vue.js based on Bulma"
                >
            </b-navbar-item>
        </template>

        <template #end>
            <b-navbar-item tag="div">
                <div class="buttons">
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

</style>
