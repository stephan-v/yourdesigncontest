<template>
    <div class="comments">
        <form @submit.prevent="submit">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Place a comment" v-model="comment" required>

                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-reply"></i>
                </button>
            </div>
        </form>

        <div class="comment mb-3" v-for="comment in comments" :key="comment.id">
            <div>{{ comment.comment }}</div>
            <small class="text-muted">{{ comment.user.name}}</small>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        data() {
            return {
                comment: '',
                comments: this.initialComments,
            };
        },

        props: {
            initialComments: {
                type: Array,
                required: true,
            },

            submission: {
                type: Object,
                required: true,
            },
        },

        methods: {
            submit() {
                axios.post(`/submissions/${this.submission.id}/comments`, {
                    comment: this.comment,
                    user_id: this.user.id,
                }).then((response) => {
                    this.comments.unshift(response.data);
                    this.comment = '';
                }).catch((error) => {
                    console.log(error.response.data);
                });
            },
        },

        computed: {
            ...mapGetters('authentication', [
                'user',
            ]),
        },
    };
</script>

<style lang="scss" scoped>
    .btn {
        border-radius: 0 0.25rem 0.25rem 0;
    }

    .comment {
        padding: 1rem;
        background: white;
    }
</style>
