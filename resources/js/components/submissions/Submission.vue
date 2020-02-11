<template>
    <div @click="open">
        <slot/>
        <submission-modal :submission="submission" @close="close" v-if="visible"/>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                visible: false,
            };
        },

        props: {
            submission: {
                required: true,
                type: Object,
            },
        },

        methods: {
            close() {
                this.visible = false;
            },

            open() {
                this.visible = true;
            },
        },
    };
</script>

<style lang="scss" scoped>
    div {
        &:hover {
            cursor: pointer;
        }
    }
</style>
