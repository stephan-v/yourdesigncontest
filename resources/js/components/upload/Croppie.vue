<template>
    <div class="upload-preview">
        <input type="hidden" name="crop" v-model="crop">

        <div class="intrinsic intrinsic--4x3">
            <input type="file" class="form-control-file" id="image" name="image" @change="getImage">

            <label for="image" class="intrinsic-item text-center" v-show="!url">
                <i class="fas fa-upload mb-2"></i>

                Select an image

                <span class="small text-muted">
                    800x600 or 1600x1200 <br> (Drag to crop the image if it does not fit)
                </span>
            </label>

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

    // File input styling.
    #image {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;

        & + label {
            font-size: 1.5rem;
            font-weight: bold;

            z-index: 10;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
    }
</style>
