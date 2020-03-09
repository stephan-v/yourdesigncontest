<template>
    <div class="user-profile-dropdown position-relative">
        <span class="nav-link cursor-pointer" @click="toggle">
            <slot name="header"/>
        </span>

        <transition enter-active-class="animated fadeInDown" leave-active-class="animated fadeOutUp">
            <div class="user-menu position-absolute bg-white" v-if="visible" v-click-outside="toggle">
                <div class="triangle"></div>
                <slot name="menu"/>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                visible: false,
            };
        },

        methods: {
            toggle() {
                this.visible = !this.visible;
            },
        },
    };
</script>

<style lang="scss" scoped>
    .user-menu {
        border-radius: 10px;
        min-width: 150px;
        top: 0;
        right: 50%;
        transform: translate(50%, 2.5rem);
        font-size: 0.875rem;
        color: grey;
        font-weight: bold;

        /deep/ a {
            // @TODO fix this.
            color: #424851 !important;
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

    .animated {
        animation-duration: 0.4s;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translate3d(0, -1rem, 0) translate(50%, 2.5rem);
        }

        to {
            opacity: 1;
            transform: translate3d(0, 0, 0) translate(50%, 2.5rem);
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
            transform: translate3d(0, -1rem, 0) translate(50%, 2.5rem);
        }
    }

    .fadeOutUp {
        animation-name: fadeOutUp;
    }
</style>
