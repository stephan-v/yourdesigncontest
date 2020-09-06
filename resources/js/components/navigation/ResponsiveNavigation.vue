<template>
    <div class="responsive-navigation" :class="classes">
        <transition enter-active-class="animated slideInRight" leave-active-class="animated slideOutRight">
            <nav class="main-navigation" v-if="visible">
                <slot></slot>
            </nav>
        </transition>

        <div class="hamburger d-flex align-items-center">
            <div class="clickable-area" @click="toggle"></div>

            <svg width="100px" height="100px" viewBox="0 0 1000 1000">
                <path id="pathA" d="M 300 400 L 700 400 C 900 400 900 750 600 850 A 400 400 0 0 1 200 200 L 800 800">
                </path>

                <path id="pathB" d="M 300 500 L 700 500"></path>

                <path id="pathC" d="M 700 600 L 300 600 C 100 600 100 200 400 150 A 400 380 0 1 1 200 800 L 800 200">
                </path>
            </svg>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                visible: false,
                open: false,
                close: false,
                animationDuration: 400,
            };
        },

        methods: {
            toggle() {
                this.visible = !this.visible;
                this.toggleBodyScroll(this.visible);
            },

            toggleBodyScroll(visible) {
                // eslint-disable-next-line
                visible
                    ? document.querySelector('html').classList.add('no-scroll')
                    : document.querySelector('html').classList.remove('no-scroll');
            },
        },

        watch: {
            visible(value) {
                const key = value ? 'open' : 'close';

                this[key] = true;

                setTimeout(() => {
                    this[key] = false;
                }, this.animationDuration);
            },
        },

        computed: {
            classes() {
                return {
                    visible: this.visible,
                    'animation-open': this.open,
                    'animation-close': this.close,
                };
            },
        },
    };
</script>

<style lang="scss" scoped>
    $color: #424851;

    .main-navigation {
        z-index: 3;
        position: fixed;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        font-size: 1.1rem;
        background: whitesmoke;

        .logo svg {
            max-width: 100px;
        }

        .container {
            padding: 1rem 15px;
            flex-direction: column;
            align-items: center;
            top: 50%;
            position: relative;
            transform: translateY(-50%);

            a {
                color: white;
                font-family: 'Signika', sans-serif;
                font-size: 1.6rem;
                margin: 0 0 0.5rem 0;
            }

            button {
                background: #879e4d;
            }
        }
    }

    .animated {
        animation-duration: .4s;
    }

    svg {
        margin-right: -15px;
    }

    .visible {
        .hamburger {
            z-index: 5;

            path {
                stroke: $color !important;
            }

            #pathA { stroke-dasharray: 2901.57, 5258.15, 240; }
            #pathB { stroke-dasharray: 400, 600, 0; }
            #pathC { stroke-dasharray: 3496.56, 6448.11, 240; }
        }
    }

    .animation-open {
        #pathA { animation: pathA 500ms ease-in-out forwards; }
        #pathB { animation: pathB 500ms ease-in-out forwards; }
        #pathC { animation: pathC 500ms ease-in-out forwards; }
    }

    .animation-close {
        #pathA { animation: pathA 500ms ease-in-out reverse; }
        #pathB { animation: pathB 500ms ease-in-out reverse; }
        #pathC { animation: pathC 500ms ease-in-out reverse; }
    }

    .hamburger {
        position: absolute;
        top: 10px;
        right: 0;
        transform: translateY(calc(-50% + 1rem));
        z-index: 3;
        overflow: hidden;

        h3 {
            color: $color;
            font-size: 1.5rem;
            margin: 0 -1.5rem 0 0;
            cursor: pointer;
        }

        .clickable-area {
            position: absolute;
            width: 40px;
            height: 40px;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        path {
            stroke: $color;
            stroke-width: 40px;
            stroke-linecap: round;
            stroke-linejoin: round;
            fill: transparent;
        }

        #pathA {
            stroke-dashoffset: 5803.15;
            stroke-dasharray: 2901.57, 2981.57, 240;
        }

        #pathB {
            stroke-dashoffset: 800;
            stroke-dasharray: 400, 480, 240;
        }

        #pathC {
            stroke-dashoffset: 6993.11;
            stroke-dasharray: 3496.56, 3576.56, 240;
        }
    }

    @keyframes pathA {
        0% { stroke-dasharray: 2901.57, 2981.57, 240; }
        80% { stroke-dasharray: 2901.57, 5358.15, 240; }
        100% { stroke-dasharray: 2901.57, 5258.15, 240; }
    }

    @keyframes pathB {
        from { stroke-dasharray: 400, 480, 240; }
        to { stroke-dasharray: 400, 600, 0; }
    }

    @keyframes pathC {
        0% { stroke-dasharray: 3496.56, 3576.56, 240; }
        80% { stroke-dasharray: 3496.56, 6548.11, 240; }
        100% { stroke-dasharray: 3496.56, 6448.11, 240; }
    }
</style>
