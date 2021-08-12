<template>
    <div>
        <div class="columns">
        <div class="column is-one-third">
            <!-- Register form -->
            <section id="reg-form">
                 <h2 class="sub-title reg-title" > Already have an account? <router-link class=" is-light" :to="{ name: 'login' }">Login</router-link></h2>
                <h1 class="title reg-title" > Create your account on <b>Tblog</b></h1>

                <b-field label="First Name" label-position="on-border">
                    <b-input type="text"
                        value=""
                       >
                    </b-input>
                </b-field>

                <b-field label="Last Name" label-position="on-border">
                    <b-input type="text"
                        value=""
                       >
                    </b-input>
                </b-field>

                <b-field label="Email"
                    message="This email is invalid" label-position="on-border">
                    <b-input type="email"
                        value="">
                    </b-input>
                </b-field>

                <b-field label="Password" label-position="on-border">
                    <b-input type="password"
                        value="iwantmytreasure"
                        password-reveal>
                    </b-input>
                </b-field>

                 <b-field label="Confirm Password" label-position="on-border">
                    <b-input type="password"
                        value="iwantmytreasure"
                        password-reveal>
                    </b-input>
                </b-field>



                <b-field  position="is-centered">
                    <b-input v-show="false"></b-input>
                    <b-button  type="is-warning" rounded>Register</b-button>
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
    name: 'Register',
        components: {
            Divider,
        }
}
</script>

<style scoped>
    #reg-form {
        margin: 78px 44px 30px 54px;
    }
    .sub-title{
        margin-bottom: 20px;
    }

    .title{
        margin-bottom: 30px;
    }

    .reg-title {
        text-align: center;
    }
</style>

