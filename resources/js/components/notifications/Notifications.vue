<template>
    <span class="position-relative mr-1 wrapper">
        <i class="fas fa-envelope" @click="toggle"></i>

        <transition enter-active-class="animated fadeIn" leave-active-class="animated fadeOut">
            <span class="count overlay" v-if="count && !visible" @click="toggle">{{ count }}</span>
        </transition>

        <transition enter-active-class="animated fadeInDown" leave-active-class="animated fadeOutUp">
            <div class="notifications position-absolute shadow-lg" v-if="visible" v-click-outside="toggle">
                <div class="triangle"></div>

                <div class="notifications-header d-flex align-items-center justify-content-between p-3">
                    <div class="d-flex align-items-center">
                        Notifications
                        <span class="count d-inline-block ml-1">{{ count }}</span>
                    </div>

                    <button type="button" class="btn btn-link p-0 font-weight-bold" @click="clear">Clear all</button>
                </div>

                <div class="notifications-body">
                    <transition-group enter-active-class="animated fadeInDown"
                                      move-class="notification-move"
                                      class="list-group"
                                      tag="ul" >
                        <notification v-for="notification in latest"
                                      :notification="notification"
                                      :key="notification.id">
                        </notification>
                    </transition-group>
                </div>

                <div class="notifications-footer text-center bg-white">
                    <a href="/notifications" class="d-block p-3">View all</a>
                </div>
            </div>
        </transition>
    </span>
</template>

<script>
    import axios from 'axios';

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
            clear() {
                axios.post('/notifications/mark-as-read').then(() => {
                    this.notifications = [];
                    this.toggle();
                });
            },

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

            latest() {
                return this.notifications.slice(0, 5);
            },
        },
    };
</script>

<style lang="scss" scoped>
    .notification-move {
        transition: transform 1s;
    }

    .fas {
        font-size: 1.3rem;
        vertical-align: middle;
    }

    .fas, .count {
        cursor: pointer;
    }

    button {
        font-size: 0.875rem;
    }

    .notifications {
        top: 0;
        right: 50%;
        z-index: 1;
        width: 300px;
        font-size: 0.875rem;
        transform: translate(50%, 2rem);
        color: grey;
    }

    .notifications-header {
        background: #fff;
        border-radius: 10px 10px 0 0;
        position: relative;
        font-weight: bold;

        border-bottom: 1px solid lightgrey;
    }

    .notifications-body {
        background: white;
        max-height: 300px;
        overflow-y: auto;

        &::-webkit-scrollbar {
            width: 3px;
        }

        &::-webkit-scrollbar-track {
            webkit-box-shadow: inset 0 0 6px #e9f0f3;
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: #e9f0f3;
        }

        &::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: grey;
            -webkit-box-shadow: none;
        }
        &::-webkit-scrollbar-thumb:window-inactive {
            background: grey;
        }
    }

    .notifications-footer {
        border-radius: 0 0 10px 10px;

        a {
            color: grey;
        }
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
        &.overlay {
            top: -0.7rem;
            right: -0.7rem;
            position: absolute;
        }
    }

    .count {
        $count: 18px;

        font-size: 0.6rem;
        background: #2899b8;
        color: #fefefe;
        width: $count;
        height: $count;
        line-height: $count;
        border-radius: 50%;
        font-weight: bold;
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
            white-space: nowrap;

            &:last-child {
                border: 0;
            }
        }
    }

    .wrapper > {
        .animated {
            animation-duration: 0.4s;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translate3d(0, -1rem, 0) translate(50%, 2rem);
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0) translate(50%, 2rem);
            }
        }

        .fadeInDown {
            animation-name: fadeInDown;
        }

        @keyframes fadeOutUp {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
                transform: translate3d(0, -1rem, 0) translate(50%, 2rem);
            }
        }

        .fadeOutUp {
            animation-name: fadeOutUp;
        }
    }
</style>
