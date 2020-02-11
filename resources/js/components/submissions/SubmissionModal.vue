<template>
    <div class="text-left">
        <div class="d-flex align-items-center justify-content-between p-4">
            <div>
                <h2 class="mb-1">{{ submission.title }}</h2>
                <div>By <a :href="profile">{{ submission.user.name }}</a></div>
            </div>

            <form class="text-center" @submit.prevent="submit">
                <button type="submit" class="btn btn-dark">
                    Select as winner <i class="fa fa-trophy ml-1" aria-hidden="true"></i>
                </button>
            </form>
        </div>

        <div class="d-flex align-content-center justify-content-center bg-white">
            <img :src="submission.path" alt="" class="img-fluid">
        </div>

        <div class="pt-4 pr-4 pl-4" v-if="submission.description">
            {{ submission.description }}
        </div>

        <div class="submission-info p-4">
            <div class="description">
                <div class="mb-3 font-weight-bold">Comments</div>
                <comments :submission="submission" class="p4"/>
            </div>

            <div class="metadata">
                <p>Test</p>
            </div>
        </div>
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
            }).then(() => {
                this.$emit('close');
            });
        },

        computed: {
            contest() {
                return this.submission.contest_id;
            },

            route() {
                return `/contests/${this.contest}/submissions/${this.submission.id}/winner`;
            },

            profile() {
                return `/users/${this.submission.user.id}`;
            },
        },

        methods: {
            submit() {
                // @TODO Add "are you sure" confirmation.
                axios.post(this.route).then((response) => {
                    window.location = response.data.redirect;
                });
            },
        },
    };
</script>

<style lang="scss">
    .submission-modal {
        width: 800px;

        .swal-content {
            margin: 0;
            padding: 0;
            border-radius: 6px;
            overflow: hidden;
            background: whitesmoke;

            h2 {
                margin: 0;
                font-weight: bold;
                font-size: 1.3rem;
            }

            img {
                max-height: 600px;
            }

            .submission-info {
                display: flex;

                .description {
                    flex: 1;
                    margin-right: 50px;
                }

                .metadata {
                    flex: 0 0 250px;
                }
            }
        }
    }
</style>
