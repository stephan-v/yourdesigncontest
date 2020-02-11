<template>
    <div class="comment mb-3">
        <div>
            <div class="font-weight-bold small mb-2">
                {{ comment.user.name }}
                <span class="text-muted font-weight-normal">{{ diffForHumans }}</span>
            </div>

            <input type="text"
                   class="mb-3"
                   v-model="comment.value"
                   ref="editable"
                   @blur="update"
                   @keyup.enter="update"
                   v-if="editing">
            <div class="mb-3" v-else>{{ comment.value }}</div>
        </div>

        <span v-if="authorized">
            <button type="submit" class="btn btn-outline-primary btn-sm" @click="edit">edit</button>
            <button type="submit" class="btn btn-outline-danger btn-sm" @click="destroy">delete</button>
        </span>
    </div>
</template>

<script>
    import dayjs from 'dayjs';
    import relativeTime from 'dayjs/plugin/relativeTime';
    import { mapGetters } from 'vuex';
    import swal from 'sweetalert';

    export default {
        data() {
            return {
                editing: false,
                comment: this.initialComment,
            };
        },

        created() {
            dayjs.extend(relativeTime);
        },

        props: {
            initialComment: {
                required: true,
                type: Object,
            },
        },

        computed: {
            ...mapGetters('authentication', [
                'user',
            ]),

            authorized() {
                return this.comment.user.id === this.user.id;
            },

            diffForHumans() {
                return dayjs(this.comment.created_at).fromNow();
            },

            route() {
                return `/comments/${this.comment.id}`;
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
                console.log(this.comment.value);

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
