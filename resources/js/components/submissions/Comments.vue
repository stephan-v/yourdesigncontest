<template>
    <div class="comments">
        <div class="mb-3 font-weight-bold">Comments</div>

        <form @submit.prevent="submit" class="mb-3" v-if="user">
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
    export default {
        data() {
            return {
                comment: '',
                comments: [],
            };
        },

        props: {
            submission: {
                type: Object,
                required: true,
            },
        },

        created() {
            // @TODO show loading animation.
            this.fetch();
        },

        computed: {
            user() {
                return this.$store.getters['authentication/user'];
            },

            route() {
                return `/submissions/${this.submission.id}/comments`;
            },
        },

        methods: {
            del(comment) {
                this.comments.splice(this.comments.indexOf(comment), 1);
            },

            fetch() {
                axios.get(this.route).then((response) => {
                    this.comments = response.data;
                }).catch((error) => {
                    console.log(error.response.data);
                });
            },

            submit() {
                axios.post(this.route, {
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

    /deep/ {
        .comment {
            margin-bottom: 1rem;

            &:last-child {
                margin: 0;
            }
        }
    }
</style>
