<template>
    <div class="upload-preview">
        <input type="file" class="form-control-file" id="file" name="file" @change="getImage">

        <div class="intrinsic intrinsic--4x3">
            <div class="intrinsic-item"
                 @mousemove="onMouseMove"
                 @mouseup="onMouseUp"
                 @mousedown="onMouseDown"
                 ref="croppie">
            </div>
        </div>
    </div>
</template>

<script>
    import Croppie from 'croppie';

    export default {
        data() {
            return {
                clicked: false,
                croppie: null,
                resizeTimer: null,
                url: null,
            };
        },

        mounted() {
            this.initCroppie();

            this.$refs.croppie.addEventListener('update', () => {
                this.croppie.result('canvas').then((blob) => {
                    console.log(blob);
                });
            });

            window.addEventListener('resize', this.resizeHandler);
        },

        beforeDestroy() {
            window.removeEventListener('resize', this.resizeHandler);
        },

        methods: {
            onMouseDown() {
                this.clicked = true;
            },

            onMouseUp() {
                this.clicked = false;
            },

            onMouseMove() {
                if (this.clicked) {
                    console.log('Moving');
                }
            },

            getImage(e) {
                const image = e.target.files[0];
                const reader = new FileReader();

                reader.readAsDataURL(image);

                // eslint-disable-next-line no-shadow
                reader.onload = (e) => {
                    this.croppie.bind({ url: e.target.result });
                    this.url = e.target.result;
                };
            },

            initCroppie() {
                this.croppie = new Croppie(this.$refs.croppie, {
                    viewport: { width: '100%', height: '100%' },
                    showZoomer: false,
                    enableZoom: false,
                    enableExif: true,
                    enableOrientation: true,
                });

                if (this.url) {
                    this.croppie.bind({ url: this.url });
                }
            },

            resizeHandler() {
                clearTimeout(this.resizeTimer);

                this.resizeTimer = setTimeout(this.refresh, 250);
            },

            refresh() {
                if (this.croppie) {
                    this.croppie.destroy();
                    this.croppie = null;
                    this.initCroppie();
                }
            },
        },
    };
</script>

<style lang="scss" scoped>
    .upload-preview {
        max-width: 800px;
    }

    .intrinsic {
        background: none;
    }
</style>
