<template>
    <div class="card-body">
        <h1>Checkout</h1>

        <form @submit.prevent>
            <div class="form-group mb-5">
                <label for="amount">Price money</label>
                <input type="number"
                       class="form-control"
                       id="amount"
                       placeholder="Amount in euro's"
                       v-model.number="amount">
                <small class="form-text text-muted">Select how much the winning designer will earn.</small>
            </div>

            <div class="card mb-5">
                <div class="card-body">
                    <h5 class="card-title">Order details</h5>

                    <ul class="total-price">
                        <li class="d-flex justify-content-between">
                            <span class="text-muted">Amount</span>
                            <span>{{ this.price.toFormat() }}</span>
                        </li>

                        <li class="d-flex justify-content-between">
                            <span class="text-muted">Fee ({{ this.percentage }}%)</span>
                            <span>{{ this.fee.toFormat() }}</span>
                        </li>

                        <li class="total d-flex justify-content-between">
                            <span class="text-muted">Total</span>
                            <span>{{ this.total.toFormat() }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" @click="submit">Checkout</button>
        </form>
    </div>
</template>

<script>
    import Dinero from 'dinero.js';

    export default {
        data() {
            return {
                amount: null,
                contest_id: 1,
                key: 'pk_test_xS6i7CE8EvKafYNJijLGchad',
                percentage: 10,
            };
        },

        created() {
            Dinero.globalFormat = '$0,0';
            Dinero.globalLocale = 'nl';
            Dinero.defaultCurrency = 'EUR';
        },

        methods: {
            submit() {
                const stripe = Stripe(this.key);

                axios.post('/checkouts', {
                    amount: this.total.getAmount(),
                    contest_id: this.contest_id,
                    email: this.email,
                    name: this.name,
                }).then((response) => {
                    stripe.redirectToCheckout({ sessionId: response.data }).then((result) => {
                        console.log(result.error);
                    });
                }).catch((error) => {
                    // Validation errors,
                    console.log(error.response.data.errors);
                });
            },
        },

        computed: {
            price() {
                return Dinero({ amount: this.amount * 100 || 0 });
            },

            fee() {
                return this.price.percentage(this.percentage);
            },

            total() {
                return this.price.add(this.fee);
            },
        },
    };
</script>

<style lang="scss" scoped>
    ul {
        margin: 0;
        padding: 0;
        list-style: none;

        li {
            margin-bottom: 0.75rem;

            &:last-child {
                margin: 0;
            }
        }

        .total {
            padding-top: 0.75rem;
            border-top: 1px dashed #b3b3b3;
        }
    }
</style>
