<template>
    <form class="signup" @submit.prevent="submit">
        <label for="email">Signup for our launch</label>
        <input type="text" id="email" class="form-control" placeholder="Email Address" v-model="email">
    </form><!-- /.signup -->
</template>

<script>
    export default {
        data() {
            return {
                email: '',
            }
        },

        methods: {
            submit() {
                console.log(this.email);
            }
        }
    };
</script>

<style lang="scss" scoped>
    .signup {
        z-index: 1;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: rotate(60deg) translate(-50%, 0%);
        font-family: 'Roboto', sans-serif;

        label {
            color: white;
            font-size: 1.2rem;
        }

        input {
            border-radius: 2rem;
            border: 0;
            padding: 0.5rem 1rem;

            &::placeholder {
                color: #006c9c;
            }
        }
    }
</style>
