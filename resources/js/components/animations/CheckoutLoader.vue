<template>
    <div class="checkout-loader">
        <transition enter-active-class="animated fadeIn" leave-active-class="animated fadeOut">
            <slot v-if="processed"></slot>
        </transition>

        <div class="d-flex flex-column align-items-center mt-3 mb-3 text-center" v-if="!processed">
            <img src="/images/svg/042-payment.svg" alt="Payment icon" class="bounce">

            <h1 id="searching-ellipsis"> Processing payment
                <span>.</span>
                <span>.</span>
                <span>.</span>
            </h1>

            <img src="/images/svg/powered_by_stripe.svg" alt="Powered by Stripe" class="mt-2">
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                paid: false,
                timer: false,
            };
        },

        created() {
            // Set a timer to mimic the payment being processed even if it has already gone through.
            setTimeout(() => {
                this.timer = true;
            }, 3000);

            // Listen for a broadcast event if the initial contest data does not have an attached payment already.
            Echo.private('users.1').listen('ContestPaid', () => {
                this.paid = true;
            });

            if (this.contest.payment) {
                this.paid = true;
            }
        },

        props: {
            contest: {
                required: true,
                type: Object,
            },
        },

        computed: {
            processed() {
                return this.paid && this.timer;
            },
        },
    };
</script>

<style lang="scss" scoped>
    h1 {
        font-size: 1.5rem;
    }

    img {
        max-width: 10rem;
        max-height: 10rem;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }

    .bounce {
        animation: bounce 2s infinite;
    }

    @keyframes opacity {
        0% {
            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
            opacity: 1;
        }
        100% {
            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
            opacity: 0;
        }
    }
    #searching-ellipsis span {
        animation: opacity 1s infinite;
    }
    #searching-ellipsis span:nth-child(2) {
        animation-delay: 100ms;
    }
    #searching-ellipsis span:nth-child(3) {
        animation-delay: 300ms;
    }
</style>
