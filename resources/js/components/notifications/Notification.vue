<template>
    <li>
        <a :href="route" class="d-flex align-items-center p-3">
            <img :src="src" alt="The user avatar" class="mr-3" :class="{ default: !avatar }">

            <div class="text-wrap">
                <b>{{ user }}</b> commented on your submission.
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
                return dayjs(this.data.commentable.created_at).fromNow();
            },

            user() {
                return this.data.user.name;
            },

            route() {
                return this.data.route;
            },

            avatar() {
                return this.data.user.avatar;
            },

            src() {
                return this.avatar || '/avatars/user.svg';
            },
        },
    };
</script>

<style lang="scss" scoped>
    a, a:hover {
        color: #747F8B;
        text-decoration: inherit;

        border: 0 solid;
        border-image: linear-gradient(to right, white 0%, #cedae0 40%, #cedae0 60%, white 100%) 1 20%
    }

    .default {
        padding: 2px;
        border: 2px solid #939393;
    }

    img {
        width: 2rem;
        border-radius: 50%;
    }
</style>
