<template>
    <div class="comments">
        <div class="mb-3 font-weight-bold">Comments</div>

        <form @submit.prevent="submit" class="mb-3">
            <textarea rows="3"
                      class="form-control mb-3"
                      placeholder="Place a comment"
                      v-model="comment"
                      required>
            </textarea>

            <button class="btn btn-primary btn-sm" type="submit">Post comment</button>
        </form>

        <transition-group enter-active-class="animated fadeIn"
                          leave-active-class="comments-leave-active animated fadeOut"
                          move-class="comments-list-move"
                          v-if="comments.length">
            <Comment v-for="comment in comments" :comment="comment" :key="comment.id" @del="del"/>
        </transition-group>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                comment: '',
                comments: [],
            };
        },

        props: {
            route: {
                type: String,
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
    };
</script>

<style lang="scss" scoped>
    input:focus {
        box-shadow: none;
        border: 0;
    }

    .comments-list-move {
        transition: transform 1s;
    }

    .comments-leave-active {
        position: absolute
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
