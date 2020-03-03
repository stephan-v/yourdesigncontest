<template>
    <div class="modal-wrapper" @click="open">
        <slot/>
    </div>
</template>

<script>
    export default {
        props: {
            submission: {
                required: true,
                type: Object,
            },
        },

        methods: {
            open() {
                this.$store.commit('submission/submission', this.submission);
                this.$store.commit('sweetalert/component', 'submission-modal');
            },
        },
    };
</script>

<style lang="scss" scoped>
    .modal-wrapper {
        &:hover {
            cursor: pointer;
        }
    }
</style>
