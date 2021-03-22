<template>
    <div class="comment">
        <div>
            <div class="font-weight-bold small mb-2">{{ comment.user.name }}</div>

            <input type="text"
                   class="mb-2 w-100"
                   v-model="comment.comment"
                   ref="editable"
                   @blur="update"
                   @keyup.enter="update"
                   v-if="editing">
            <div class="mb-2" v-else>{{ comment.comment }}</div>
        </div>

        <span class="text-muted d-flex justify-content-between">
            <span>{{ time }}</span>

            <div>
                <span class="cursor-pointer" @click="edit" v-if="authorized">edit | </span>
                <span class="cursor-pointer" @click="destroy" v-if="authorized">delete</span>
            </div>
        </span>
    </div>
</template>

<script>
    import axios from 'axios';
    import formatDistanceToNow from 'date-fns/formatDistanceToNow';
    import swal from 'sweetalert';

    export default {
        data() {
            return {
                editing: false,
                time: null,
            };
        },

        created() {
            this.setHumanReadableCreationTime();

            setInterval(this.setHumanReadableCreationTime, 5000);
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

            route() {
                return `/api/comments/${this.comment.id}`;
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

                    this.$store.commit('sweetalert/close');
                });
            },

            update() {
                axios.patch(this.route, {
                    comment: this.comment.comment,
                    user_id: this.comment.user.id,
                }).then(() => {
                    this.editing = false;
                }).catch((error) => {
                    console.log(error.response.data);
                });
            },

            setHumanReadableCreationTime() {
                this.time = formatDistanceToNow(new Date(this.comment.created_at), { addSuffix: true });
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
