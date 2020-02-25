<template>
    <span class="position-relative mr-1">
        <i class="fas fa-envelope" @click="toggle"></i>

        <span class="count" v-if="count" @click="toggle">{{ count }}</span>

        <div class="notifications position-absolute z-index-1" v-if="visible" v-click-outside="toggle">
            <div class="triangle"></div>

            <div class="notifications-header text-center p-3 font-weight-bold">Notifications</div>

            <div class="notifications-body">
                <ul class="list-group" >
                    <notification v-for="notification in notifications"
                                  :notification="notification"
                                  :key="notification.id">
                    </notification>

                    <li v-if="!notifications.length">No new messages</li>
                </ul>
            </div>
        </div>
    </span>
</template>

<script>
    export default {
        data() {
            return {
                notifications: this.initialNotifications || [],
                visible: false,
            };
        },

        created() {
            Echo.private(`users.${this.user.id}`).notification((notification) => {
                this.notifications.unshift(notification);
            });
        },

        props: {
            initialNotifications: {
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
            user() {
                return this.$store.getters['authentication/user'];
            },

            count() {
                return this.notifications.length;
            },
        },
    };
</script>

<style lang="scss" scoped>
    .fas {
        font-size: 1.375rem;
    }

    .fas, .count {
        cursor: pointer;
    }

    .notifications {
        top: 0;
        right: 50%;
        width: 280px;
        font-size: 0.875rem;
        transform: translate(50%, 2rem);
    }

    .notifications-header {
        background: #fff;
        color: grey;
        border-radius: 10px 10px 0 0;
    }

    .notifications-body {
        background: #e9f0f3;
    }

    .triangle {
        position: absolute;
        height: 1rem;
        width: 1rem;
        border-radius: 6px 0 0 0;
        top: -5px;
        transform: translateX(50%) rotate(45deg);
        right: 50%;
        background: #FFF;
    }

    .count {
        top: -0.8rem;
        right: -0.8rem;
        font-size: 0.6em;
        background: #2ba1c3;
        color: #fefefe;
        width: 1.3rem;
        height: 1.3rem;
        border-radius: 50%;
        position: absolute;
        font-weight: bold;
        line-height: 1.4rem;
        text-align: center;
    }

    .list-group {
        right: 0;
        top: 2rem;
        z-index: 1;
        color: #424851;
        list-style: none;
        border-radius: 0.25rem;

        li {
            border-bottom: 1px solid #e0e0e0;
            white-space: nowrap;

            a {
                //
            }

            &:last-child {
                border: 0;
            }
        }
    }
</style>
