<template>
    <div class="comment mb-3">
        <input type="text" v-model="comment.value" ref="editable" @blur="update" @keyup.enter="update" v-if="editing">
        <div v-else>{{ comment.value }}</div>

        <small class="text-muted">{{ comment.user.name }}</small>

        <div v-if="authorized">
            <small class="text-muted" @click="edit">edit</small>
            <small class="text-muted" @click="destroy">delete</small>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import swal from 'sweetalert';

    export default {
        data() {
            return {
                editing: false,
                comment: this.initialComment,
            };
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
    }
</style>
