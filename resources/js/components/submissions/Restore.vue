<template>
    <i class="fas fa-trash-restore" title="Restore your submission" @click="restore"/>
</template>

<script>
    import swal from 'sweetalert';

    export default {
        props: {
            route: {
                required: true,
                type: String,
            },
        },

        methods: {
            restore() {
                axios.post(this.route).then(() => {
                    swal(
                        'Submission restored.',
                        'Your submission is back in the contest',
                        'success',
                    ).then(() => {
                        window.location.reload();
                    });
                });
            },
        },
    };
</script>

<style lang="scss" scoped>
    .fas {
        top: 0;
        right: 0;
        padding: 1rem;
        cursor: pointer;
        background: white;
        position: absolute;
    }
</style>
