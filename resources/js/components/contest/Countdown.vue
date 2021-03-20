<template>
    <span>{{ countdown }}</span>
</template>

<script>
    import dayjs from 'dayjs';

    export default {
        props: {
            endDate: {
                required: true,
                type: String,
            },
        },

        data() {
            return {
                countdown: null,
                now: dayjs(),
            };
        },

        created() {
            this.setCountdown();

            setInterval(this.setCountdown, 1000);
        },

        methods: {
            setCountdown() {
                const differenceInSeconds = dayjs(this.endDate).unix() - dayjs().unix();

                if (differenceInSeconds === 0) {
                    window.location.reload();
                }

                if (differenceInSeconds > 86400) {
                    this.countdown = dayjs(this.endDate).fromNow();
                    return;
                }

                this.countdown = dayjs.duration(differenceInSeconds * 1000).format('HH:mm:ss');
            },
        },
    };
</script>
