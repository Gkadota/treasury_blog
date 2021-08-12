<template>
    <div>
        <NavBar v-if="!['login', 'register'].includes($route.name)"></NavBar>
            <router-view></router-view>
    </div>
</template>
<script>
import NavBar from '../components/Navbar'
    export default {
        name: 'App',
        components: {
            NavBar,
        }
    }
</script>
