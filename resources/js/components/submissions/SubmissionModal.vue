<template>
    <div class="text-left">
        <div class="d-flex align-items-center justify-content-between p-4">
            <div>
                <h2 class="mb-1">{{ submission.title }}</h2>
                <div>By <a :href="profile">{{ submission.user.name }}</a></div>
            </div>

            <form class="text-center" @submit.prevent="award" v-if="!locked && owner">
                <button type="submit" class="btn btn-dark">Select as winner <i class="fas fa-award ml-1"></i></button>
            </form>
        </div>

        <div class="d-flex align-content-center justify-content-center bg-white">
            <picture class="intrinsic intrinsic--4x3">
                <submission-image :path="submission.path" class="img-fluid"/>
            </picture>
        </div>

        <div class="submission-info p-4">
            <div class="description">
                <div class="mb-3" v-if="submission.description">
                    {{ submission.description }}
                </div>

                <comments :route="commentRoute" class="p4"/>
            </div>

            <div class="metadata">
                <span class="d-flex align-items-center mb-3">
                    <i class="far fa-calendar mr-3"></i> {{ created }}
                </span>

                <span class="d-flex align-items-center mb-3">
                    <i class="fas fa-palette mr-3"></i> <palette/>
                </span>

                <span class="d-flex align-items-center" v-if="owner">
                    <form @submit.prevent="del" v-if="deletable">
                        <button type="submit" class="btn btn-dark btn-sm">
                            <i class="fas fa-trash mr-3"></i> Withdraw submission
                        </button>
                    </form>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    import dayjs from 'dayjs';
    import swal from 'sweetalert';

    export default {
        props: {
            submission: {
                required: true,
                type: Object,
            },
        },

        mounted() {
            this.openModal();
        },

        computed: {
            deletable() {
                return !this.submission.deleted_at && !this.submission.winner;
            },

            owner() {
                // @TODO check this when logged out.
                return this.user.id === this.submission.contest.user_id;
            },

            locked() {
                return this.$store.getters['contest/locked'];
            },

            user() {
                return this.$store.getters['authentication/user'] || {};
            },

            created() {
                return dayjs(this.submission.created_at).format('MMM D, YYYY');
            },

            contest() {
                return this.submission.contest_id;
            },

            route() {
                return `/contests/${this.contest}/submissions/${this.submission.id}`;
            },

            profile() {
                return `/users/${this.submission.user.id}`;
            },

            commentRoute() {
                return `api/submissions/${this.submission.id}/comments`;
            },
        },

        methods: {
            openModal() {
                swal({
                    buttons: false,
                    className: 'submission-modal',
                    content: this.$el,
                }).then(() => {
                    this.$emit('close');
                });
            },

            del() {
                axios.delete(this.route).then(() => {
                    swal(
                        'Submission deleted.',
                        'You can always restore your submission',
                        'success',
                    ).then(() => {
                        window.location.reload();
                    });
                });
            },

            award() {
                swal({
                    icon: 'warning',
                    title: 'Are you sure?',
                    text: 'This submission will be assigned as the winner of your contest.',
                    buttons: true,
                    dangerMode: true,
                }).then((willAssignWinner) => {
                    if (willAssignWinner) {
                        axios.post(`${this.route}/award`).then((response) => {
                            window.location = response.data.redirect;
                        });
                    }

                    this.$emit('close');
                });
            },
        },
    };
</script>

<style lang="scss">
    @media (min-width: 768px) {
        .submission-modal {
            width: 768px;
        }
    }

    .submission-modal {
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
                max-width: 90%;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
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
