<template>
    <div>
        <div class="d-flex align-content-center justify-content-center">
            <img :src="submission.path" alt="" class="img-fluid" style="max-height: 300px">
        </div>

        <div v-if="submission.description">
            <small class="text-muted d-block mb-1">Description from {{ submission.user.name }}</small>
            {{ submission.description }}
        </div>

        <form class="text-center mb-5 mt-5" @submit.prevent="submit">
            <button type="submit" class="btn btn-primary">Select as winner</button>
        </form>

        <comments :submission="submission"/>
    </div>
</template>

<script>
    import swal from 'sweetalert';

    export default {
        props: {
            submission: {
                required: true,
                type: Object,
            },
        },

        mounted() {
            swal({
                buttons: false,
                className: 'submission-modal',
                content: this.$el,
            }).then(() => this.$emit('close'));
        },

        computed: {
            contest() {
                return this.submission.contest_id;
            },

            route() {
                return `/contests/${this.contest}/submissions/${this.submission.id}/winner`;
            },
        },

        methods: {
            submit() {
                axios.post(this.route).then((response) => {
                    window.location = response.data.redirect;
                });
            },
        },
    };
</script>

<style lang="scss">
    .submission-modal {
        .swal-content {
            margin: 0;
            padding: 0;
        }
    }
</style>
