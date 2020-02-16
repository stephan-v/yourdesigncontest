<template>
    <div class="upload-preview">
        <label for="image">File</label>
        <input type="file" class="form-control-file" id="image" name="image" @change="getImage">

        <input type="hidden" name="crop" v-model="crop">

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
                crop: [],
                croppie: null,
                resizeTimer: null,
                url: null,
            };
        },

        mounted() {
            this.initCroppie();

            this.$refs.croppie.addEventListener('update', this.updateHandler);

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
                    //
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
                    initialZoom: 0,
                    mouseWheelZoom: false,
                    showZoomer: false,
                    enableExif: true,
                    enableOrientation: true,
                    viewport: {
                        width: '100%',
                        height: '100%',
                    },
                    maxZoom: 1,
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

            updateHandler() {
                this.croppie.result('canvas').then(() => {
                    this.crop = this.croppie.get().points;
                });
            },
        },
    };
</script>

<style lang="scss" scoped>
    /deep/ .croppie-container {
        // On drag remove the overflow.
        .cr-boundary[aria-dropeffect="move"] {
            overflow: inherit;
        }
    }

    .upload-preview {
        max-width: 800px;
    }

    .intrinsic {
        background: none;
    }
</style>
