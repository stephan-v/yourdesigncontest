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
    import dayjs from 'dayjs';
    import relativeTime from 'dayjs/plugin/relativeTime';

    export default {
        props: {
            notification: {
                required: true,
                type: Object,
            },
        },

        created() {
            dayjs.extend(relativeTime);
        },

        computed: {
            data() {
                return this.notification.data;
            },

            diffForHumans() {
                return dayjs(this.notification.created_at).fromNow();
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

        border: 0 solid;
        border-image: linear-gradient(to right, white 0%, #cedae0 40%, #cedae0 60%, white 100%) 1 20%
    }

    img {
        width: 2rem;
        border-radius: 50%;
    }
</style>
