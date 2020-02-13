<template>
    <img :src="path" class="intrinsic-item">
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
            const image = this.$el;
            const colorThief = new ColorThief();

            image.addEventListener('load', () => {
                this.$store.commit('submission/palette', colorThief.getPalette(image, 5));
            });
        },
    };
</script>
