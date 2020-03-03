<template>
    <div class="comment">
        <div>
            <div class="font-weight-bold small mb-2">{{ comment.user.name }}</div>

            <input type="text"
                   class="mb-2"
                   v-model="comment.value"
                   ref="editable"
                   @blur="update"
                   @keyup.enter="update"
                   v-if="editing">
            <div class="mb-2" v-else>{{ comment.value }}</div>
        </div>

        <span class="text-muted">
            <template>{{ diffForHumans }}</template>
            <template @click="edit" v-if="authorized"> | edit</template>
            <template @click="destroy" v-if="authorized" >delete</template>
        </span>
    </div>
</template>

<script>
    import dayjs from 'dayjs';
    import relativeTime from 'dayjs/plugin/relativeTime';
    import swal from 'sweetalert';

    export default {
        data() {
            return {
                editing: false,
            };
        },

        created() {
            dayjs.extend(relativeTime);
        },

        props: {
            comment: {
                type: Object,
            },
        },

        computed: {
            user() {
                return this.$store.getters['authentication/user'];
            },

            authorized() {
                return this.comment.user.id === this.user.id;
            },

            diffForHumans() {
                return dayjs(this.comment.created_at).fromNow();
            },

            route() {
                return `api/comments/${this.comment.id}`;
            },
        },

        methods: {
            edit() {
                this.editing = true;
                this.$nextTick(this.focus);
            },

            focus() {
                this.$refs.editable.focus();
            },

            destroy() {
                // Confirm deletion.
                swal({
                    icon: 'warning',
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this comment.',
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        // @TODO move all Axios calls to the parent?
                        axios.delete(this.route).then(() => this.$emit('del', this.comment));
                    }
                });
            },

            update() {
                axios.patch(this.route, {
                    user_id: this.comment.user.id,
                    value: this.comment.value,
                }).then(() => {
                    this.editing = false;
                }).catch((error) => {
                    console.log(error.response.data);
                });
            },
        },
    };
</script>

<style lang="scss" scoped>
    .comment {
        padding: 1rem;
        background: white;

        input {
            border: 0;
            outline: 0;
        }
    }
</style>
