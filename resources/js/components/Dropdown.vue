<template>
    <div class="user-profile-dropdown position-relative">
        <span @click="toggle">
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
    $top-offset: 2.5rem;

    .user-menu {
        border-radius: 10px;
        min-width: 150px;
        top: 0;
        right: 50%;
        transform: translate(50%, $top-offset);
        font-size: 0.875rem;
        color: grey;
        font-weight: bold;
        box-shadow: 0 2px 10px -2px #cedae0;
        z-index: 1;

        /deep/ a {
            // @TODO fix this.
            color: #424851 !important;
            border-bottom: 1px solid #e4e4e4;

            &:last-child {
                border: 0;
            }
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
            transform: translate3d(0, -1rem, 0) translate(50%, $top-offset);
        }

        to {
            opacity: 1;
            transform: translate3d(0, 0, 0) translate(50%, $top-offset);
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
            transform: translate3d(0, -1rem, 0) translate(50%, $top-offset);
        }
    }

    .fadeOutUp {
        animation-name: fadeOutUp;
    }
</style>
