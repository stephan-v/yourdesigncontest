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
                return this.comment.id === this.user.id;
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
                swal('Destroy');
            },

            update() {
                axios.patch(`/comments/${this.comment.id}`, {
                    user_id: this.comment.user.id,
                    value: this.comment.value,
                }).then(() => {
                    this.editing = false;
                    this.editable = '';
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
