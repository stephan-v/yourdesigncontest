<template>
    <form class="signup" @submit.prevent="submit" @keydown="clear">
        <label for="email">Signup for our launch</label>

        <div class="d-flex position-relative">
            <input type="text" id="email" class="form-control" placeholder="Email Address" v-model="email">
            <input type="submit" value="signup" class="ml-1 submit">
            <error :error="error" :key="error" v-for="error in errors"></error>
        </div><!-- /.d-flex -->
    </form><!-- /.signup -->
</template>

<script>
    import swal from 'sweetalert';

    export default {
        data() {
            return {
                email: '',
                errors: [],
            };
        },

        methods: {
            clear() {
                this.errors = [];
            },

            submit() {
                axios.post('/register', { email: this.email }).then((response) => {
                    swal(response.data);
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                });
            },
        },
    };
</script>

<style lang="scss" scoped>
    .signup {
        z-index: 1;
        position: absolute;
        top: 55%;
        left: 45%;
        transform: rotate(60deg) translate(-50%, 0%);
        font-family: 'Roboto', sans-serif;
        width: 300px;

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

        .submit {
            outline: 0;
            color: white;
            background-color: orange;
        }
    }
</style>
