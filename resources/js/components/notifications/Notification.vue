<template>
    <li>
        <a :href="route" class="d-flex align-items-center p-3">
            <img :src="data.avatar" alt="The user avatar" class="mr-3">

            <div class="text-wrap">
                <span class="message" v-html="data.message"></span>
                (<span class="text-muted">{{ diffForHumans }}</span>)
            </div>
        </a>
    </li>
</template>

<script>
    import formatDistanceToNow from 'date-fns/formatDistanceToNow';

    export default {
        props: {
            notification: {
                required: true,
                type: Object,
            },
        },

        computed: {
            createdAt() {
                return new Date(this.notification.created_at);
            },

            data() {
                return this.notification.data;
            },

            diffForHumans() {
                return formatDistanceToNow(this.createdAt, { addSuffix: true });
            },

            route() {
                return this.data.route;
            },
        },
    };
</script>

<style lang="scss" scoped>
    .animated {
        transition: background-color 0.4s linear;
    }

    .fadeInDown {
        background: darken(#e9f0f3, 2%);
    }

    a, a:hover {
        color: #747F8B;
        text-decoration: inherit;
        border-bottom: 1px solid lightgrey;
    }

    img {
        width: 2rem;
        border-radius: 50%;
    }
</style>
