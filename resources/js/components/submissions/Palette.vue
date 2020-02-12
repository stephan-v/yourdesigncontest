<template>
    <ul class="d-flex list-unstyled mb-0">
        <li v-for="hex in hexes" :style="{ background: hex }" :title="hex" :key="hex"></li>
    </ul>
</template>

<script>
    export default {
        computed: {
            palette() {
                return this.$store.getters['submission/palette'];
            },

            hexes() {
                return this.palette.map((rgb) => this.rgbToHex(...rgb));
            },
        },

        methods: {
            rgbToHex(r, g, b) {
                // eslint-disable-next-line
                return `#${((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1)}`;
            },
        },
    };
</script>

<style lang="scss" scoped>
    ul {
        width: 220px;
    }

    li {
        width: 20%;
        height: 18px;

        &:hover {
            transform: scale(1.5);
            box-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        &:first-child {
            border-radius: 3px 0 0 3px;
        }

        &:last-child {
            border-radius: 0 3px 3px 0;
        }
    }
</style>
