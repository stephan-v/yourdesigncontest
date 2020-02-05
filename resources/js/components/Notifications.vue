<template>
    <span class="position-relative">
        <i class="fa fa-envelope fa-lg" aria-hidden="true" @click="toggle"></i>

        <span class="count position-absolute d-inline-block font-weight-bold text-center" v-if="count" @click="toggle">
            {{ count }}
        </span>

        <ul class="list-group position-absolute bg-white z-index-1" v-if="count && visible">
            <li v-for="notification in notifications" :key="notification.id" v-html="notification.data.message"/>
        </ul>
    </span>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        data() {
            return {
                visible: false,
            };
        },

        created() {
            Echo.private(`users.${this.user.id}`).notification((notification) => {
                console.log(notification.type);
            });
        },

        props: {
            notifications: {
                type: Array,
                required: true,
            },
        },

        methods: {
            toggle() {
                this.visible = !this.visible;
            },
        },

        computed: {
            ...mapGetters('authentication', [
                'user',
            ]),

            count() {
                return this.notifications.length;
            },
        },
    };
</script>

<style lang="scss" scoped>
    .fa, .count {
        cursor: pointer;
    }

    .count {
        top: -0.6rem;
        right: -0.6rem;
        font-size: 0.6em;
        background: #cc4b37;
        color: #fefefe;
        min-width: 2.1em;
        padding: 0.3em;
        border-radius: 50%;
    }

    .list-group {
        right: 0;
        top: 2rem;
        z-index: 1;
        color: #424851;
        min-width: 300px;
        list-style: none;
        border-radius: 0.25rem;

        li {
            padding: 0.6rem 1rem;
            border-bottom: 1px solid #e0e0e0;

            &:last-child {
                border: 0;
            }
        }
    }
</style>
