<template>
    <div class="comment mb-3">
        <div>{{ comment.comment }}</div>
        <small class="text-muted">{{ comment.user.name }}</small>
    </div>
</template>

<script>
    export default {
        props: {
            comment: {
                required: true,
                type: Object,
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
