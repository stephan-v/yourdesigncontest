<script>
    import swal from 'sweetalert';

    export default {
        props: {
            data: {
                type: Object,
            },
        },

        render() {
            return null;
        },

        mounted() {
            swal(this.data);
        },
    };
</script>
