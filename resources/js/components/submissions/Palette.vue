<template>
    <ul class="d-flex list-unstyled mb-0">
        <li v-for="hex in hexCodes" :style="{ background: hex }" :key="hex"></li>
    </ul>
</template>

<script>
    export default {
        props: {
            colors: {
                required: true,
                type: Array,
            },
        },

        computed: {
            hexCodes() {
                return this.colors.map((color) => this.rgbToHex(...color));
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

        &:first-child {
            border-radius: 3px 0 0 3px;
        }

        &:last-child {
            border-radius: 0 3px 3px 0;
        }
    }
</style>
