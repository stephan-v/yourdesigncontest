<template>
    <form @submit.prevent>
        <div class="form-group">
            <label for="name">Contest name</label>
            <input type="text"
                   class="form-control"
                   id="name"
                   placeholder="Name of your contest"
                   v-model="name">
            <small class="form-text text-muted">Please provide the name of your design contest.</small>
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number"
                   class="form-control"
                   id="amount"
                   placeholder="Amount in euro's"
                   v-model.number="amount">
            <small class="form-text text-muted">Select your own price.</small>
        </div>

        <button type="submit" class="btn btn-primary" @click="submit">Checkout</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                amount: null,
                key: 'pk_test_xS6i7CE8EvKafYNJijLGchad',
                name: null,
            }
        },

        methods: {
            submit() {
                const stripe = Stripe(this.key);

                axios.post('/checkouts', {
                    amount: this.amount,
                    name: this.name,
                }).then(response => {
                    stripe.redirectToCheckout({ sessionId: response.data }).then(result => {
                        console.log(result.error);
                    });
                });
            },
        },
    };
</script>
