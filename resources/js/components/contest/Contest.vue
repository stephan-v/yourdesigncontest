<script>
    export default {
        // Only used to pass in Vuex prop data.
        render() {
            return null;
        },

        props: {
            locked: {
                required: true,
                type: Boolean,
            },
        },

        created() {
            this.$store.commit('contest/locked', this.locked);
        },
    };
</script>
