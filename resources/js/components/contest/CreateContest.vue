<template>
    <div class="card">
        <component :is="component" @next="next"></component>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                id: null,
                step: 0,
                steps: [
                    'contest',
                    'checkout',
                ],
            };
        },

        computed: {
            component() {
                return this.steps[this.step];
            },
        },

        methods: {
            next() {
                this.step += 1;
            },
        },
    };
</script>
