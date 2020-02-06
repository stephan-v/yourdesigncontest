<template>
    <div class="comment mb-3">
        <input type="text" v-model="editable" ref="editable" @blur="update" @keyup.enter="update" v-if="editing">
        <div v-else>{{ comment.comment }}</div>

        <small class="text-muted">{{ comment.user.name }}</small>
        <small class="text-muted" @click="edit">edit</small>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                editing: false,
                editable: this.comment.comment,
            };
        },

        props: {
            comment: {
                required: true,
                type: Object,
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

            update() {
                axios.patch(`/comments/${this.comment.id}`, {
                    comment: this.editable,
                    user_id: this.comment.user.id,
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
