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

        <Comment v-for="comment in comments"
                 :key="comment.id"
                 :initial-comment="comment"
                 @del="del">
        </Comment>
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

        computed: {
            ...mapGetters('authentication', [
                'user',
            ]),
        },

        methods: {
            del(comment) {
                this.comments.splice(this.comments.indexOf(comment), 1);
            },

            submit() {
                axios.post(`/submissions/${this.submission.id}/comments`, {
                    user_id: this.user.id,
                    value: this.comment,
                }).then((response) => {
                    this.comments.unshift(response.data);
                    this.comment = '';
                }).catch((error) => {
                    console.log(error.response.data);
                });
            },
        },
    };
</script>

<style lang="scss" scoped>
    .btn {
        border-radius: 0 0.25rem 0.25rem 0;
    }
</style>
