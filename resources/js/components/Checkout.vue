<template>
    <button type="submit" class="btn btn-primary" @click="submit">Submit</button>
</template>

<script>
    export default {
        data() {
            return {
                key: 'pk_test_jO0mhJ9TWGvIl7jcbe6RIe3u00KPCp5aCY',
            }
        },

        methods: {
            submit() {
                const stripe = Stripe(this.key);

                axios.get('checkout-session').then(response => {
                    stripe.redirectToCheckout({ sessionId: response.data.id }).then(result => {
                        console.log(result.error);
                    });
                });
            },
        },
    };
</script>
