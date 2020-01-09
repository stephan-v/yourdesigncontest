<template>
    <div class="card-body">
        <h1>Register</h1>

        <form @submit.prevent>
            <div class="form-group">
                <label for="name">Your email</label>
                <input type="text"
                       class="form-control"
                       id="email"
                       placeholder="Your email address"
                       v-model="email">
                <small class="form-text text-muted">Please provide your email address.</small>
            </div>

            <button type="submit" class="btn btn-primary" @click="submit">Next</button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: null,
            };
        },

        methods: {
            submit() {
                this.$emit('next');
            },
        },
    };
</script>
