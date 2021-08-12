<template>
    <div>
        <h1>Vue Router Demo App</h1>
        <p>
            <router-link :to="{ name: 'home' }">Home</router-link> |
            <router-link :to="{ name: 'register' }">Register</router-link>
        </p>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'App'
    }
</script>
