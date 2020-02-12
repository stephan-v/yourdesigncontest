<template>
    <img :src="path">
</template>

<script>
    import ColorThief from 'colorthief/dist/color-thief.umd';

    export default {
        props: {
            path: {
                required: true,
                type: String,
            },
        },

        mounted() {
            this.setColorPalette();
        },

        methods: {
            setColorPalette() {
                const image = this.$el;
                const colorThief = new ColorThief();

                image.addEventListener('load', () => {
                    this.$emit('loaded', colorThief.getPalette(image, 5));
                });
            },
        },
    };
</script>

<style lang="scss" scoped>

</style>
