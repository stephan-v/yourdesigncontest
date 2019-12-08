<template>
    <div class="alert alert-danger position-absolute" role="alert">
        {{ error[0] }}
    </div><!-- /.alert -->
</template>

<script>
    export default {
        props: {
            error: {
                type: Array,
                required: true,
            }
        }
    };
</script>

<style lang="scss" scoped>
    .alert {
        margin: 0;
        padding: 0.5rem;
        transform: translateY(100%);
        background: #F05A5C;
        border: 0;
        color: white;
        font-size: 0.8rem;
        bottom: -5px;

        &:after {
            content: '';
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-bottom: 5px solid #F05A5C;
            top: -4px;
            left: 50%;
            position: absolute;
        }
    }
</style>
