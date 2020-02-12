<template>
    <div class="comments">
        <div class="mb-3 font-weight-bold">Comments</div>

        <form @submit.prevent="submit" v-if="user">
            <textarea rows="3"
                      class="form-control mb-3"
                      placeholder="Place a comment"
                      v-model="comment"
                      required>
            </textarea>

            <button class="btn btn-primary btn-sm" type="submit">Post comment</button>
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
                comments: this.initialComments || [],
            };
        },

        props: {
            initialComments: {
                type: Array,
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
    input:focus {
        box-shadow: none;
        border: 0;
    }
</style>
