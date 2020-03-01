<template>
    <div class="mt-5"></div>
</template>

<script>
    const Uppy = require('@uppy/core');
    const Dashboard = require('@uppy/dashboard');
    const Tus = require('@uppy/tus');

    export default {
        props: {
            contestId: {
                required: true,
                type: Number,
            },
        },

        mounted() {
            const uppy = Uppy({
                debug: true,
                limit: 10,
                meta: {
                    contest_id: this.contestId,
                },
            }).use(Dashboard, {
                inline: true,
                target: this.$el,
            }).use(Tus, {
                endpoint: '/tus/',
                resume: true,
                autoRetry: true,
                retryDelays: [0, 1000, 3000, 5000],
            });

            uppy.on('complete', (result) => {
                console.log('Upload complete! We’ve uploaded these files:', result.successful);
            });
        },
    };
</script>

<style lang="scss" scoped>
    @import '~@uppy/core/dist/style.css';
    @import '~@uppy/dashboard/dist/style.css';
</style>
