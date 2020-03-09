<template>
    <div class="user-profile-dropdown position-relative">
        <span class="nav-link cursor-pointer" @click="toggle">
            <slot name="header"/>
        </span>

        <transition enter-active-class="animated fadeIn" leave-active-class="animated fadeOut">
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
                console.log('toggle');

                this.visible = !this.visible;
            },
        },
    };
</script>

<style lang="scss" scoped>
    .animated {
        animation-duration: 0.4s;
    }

    .user-menu {
        border-radius: 10px;
        min-width: 200px;
        transform: translate(50%, 1rem);

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
</style>
