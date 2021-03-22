<template>
    <span>{{ countdown }}</span>
</template>

<script>
    import formatDistanceToNowStrict from 'date-fns/formatDistanceToNowStrict';
    import isPast from 'date-fns/isPast';

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
                now: new Date(),
            };
        },

        created() {
            this.setCountdown();

            setInterval(this.setCountdown, 1000);
        },

        computed: {
            expiresAt() {
                return new Date(this.endDate);
            },
        },

        methods: {
            setCountdown() {
                if (isPast(this.expiresAt)) {
                    window.location.reload();
                }

                this.countdown = formatDistanceToNowStrict(this.expiresAt, {
                    addSuffix: true,
                    roundingMethod: 'floor',
                });
            },
        },
    };
</script>
