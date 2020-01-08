<template>
    <form @submit.prevent>
        <div class="form-group">
            <label for="name">Your email</label>
            <input type="text"
                   class="form-control"
                   id="email"
                   placeholder="Your email address"
                   v-model="email">
            <small class="form-text text-muted">Please provide your email address.</small>
        </div>

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
                <h5 class="card-title">Order summary</h5>

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
</template>

<script>
    import Dinero from 'dinero.js';

    export default {
        data() {
            return {
                amount: null,
                email: null,
                key: 'pk_test_xS6i7CE8EvKafYNJijLGchad',
                name: null,
                percentage: 10,
            }
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
                    email: this.email,
                    amount: this.total.getAmount(),
                    name: this.name,
                }).then(response => {
                    stripe.redirectToCheckout({ sessionId: response.data }).then(result => {
                        console.log(result.error);
                    });
                }).catch(response => {
                    // Validation errors,
                    console.log(response);
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
            }
        }
    };
</script>

<style lang="scss" scoped>
    ul {
        margin: 0;
        padding: 0;
        list-style: none;

        li {
            margin-bottom: 0.5rem;

            &:last-child {
                margin: 0;
            }
        }

        .total {
            padding-top: 0.5rem;
            border-top: 1px solid #6c757d;
        }
    }
</style>
