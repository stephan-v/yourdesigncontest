<template>
    <component :is="component"/>
</template>

<script>
    export default {
        props: {
            flashModal: {
                required: false,
                type: String,
            },
        },

        created() {
            if (this.flashModal) {
                this.setComponent(this.flashModal);
            }
        },

        methods: {
            setComponent(component) {
                this.$store.commit('sweetalert/component', component);
            },
        },

        computed: {
            component() {
                return this.$store.getters['sweetalert/component'];
            },
        },
    };
</script>
