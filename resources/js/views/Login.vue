<template>
    <div>
        <div class="columns">
        <div class="column is-one-third">
            <!-- Login form -->
            <section id="login-form">
                <h1 class="title login-title" > Login to Tblog</h1>
                <h2 class="sub-title login-title" > Don't have an account? <router-link class=" is-light" :to="{ name: 'register' }">Register</router-link></h2>
                <b-field label="Email"
                    type=""
                    message="This email is invalid">
                    <b-input type="email"
                        value="john@"
                        maxlength="30">
                    </b-input>
                </b-field>

                <b-field label="Password">
                    <b-input type="password"
                        value="iwantmytreasure"
                        password-reveal>
                    </b-input>
                </b-field>

                <b-field position="is-centered">
                    <b-input v-show="false"></b-input>
                    <a href="" class="is-dark"> Forgot your password?</a>
                </b-field>


                <b-field  position="is-centered">
                    <b-input v-show="false"></b-input>
                    <b-button  type="is-warning" rounded>Sign In</b-button>
                </b-field>


            </section>

        </div>
            <Divider />
    </div>

    </div>


</template>

<script>
import Divider from '../components/Divider';

export default {
    name:'Login',
    components: {
        Divider
    },
}
</script>

<style scoped>
    #login-form {
                margin: 120px 30px 120px 63px;
    }

    .login-title {
        text-align: center;
    }
</style>

