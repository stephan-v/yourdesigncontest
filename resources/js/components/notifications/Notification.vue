<template>
    <li>
        <a :href="route" class="d-block p-3">
            <img :src="avatar" alt="The user avatar" class="mr-3">
            You have a new comment.
        </a>
    </li>
</template>

<script>
    export default {
        props: {
            notification: {
                required: true,
                type: Object,
            },
        },

        computed: {
            data() {
                return this.notification.data;
            },

            route() {
                return this.data.route;
            },

            avatar() {
                return this.data.user.avatar;
            },
        },
    };
</script>

<style lang="scss" scoped>
    a {

    }

    img {
        width: 32px;
        border-radius: 50%;
    }
</style>
