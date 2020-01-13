<template>
    <div class="card">
        <div class="card-body">
            <h1>Checkout</h1>

            <form @submit.prevent>
                <div class="form-group mb-3">
                    <label for="amount">Price money</label>
                    <input type="number"
                           class="form-control"
                           id="amount"
                           placeholder="Amount in euro's"
                           v-model.number="amount">
                    <small class="form-text text-muted">Select how much the winning designer will earn.</small>
                </div>

                <div class="card mb-3">
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

                <img src="/images/powered_by_stripe.png" alt="" class="d-block mb-3">

                <button type="submit" class="btn btn-primary" @click="submit">Checkout</button>
            </form>
        </div>
    </div>
</template>

<script>
    import Dinero from 'dinero.js';
    import { mapGetters } from 'vuex';

    export default {
        data() {
            return {
                amount: null,
                stripe: Stripe('pk_test_xS6i7CE8EvKafYNJijLGchad'),
                percentage: 10,
            };
        },

        props: {
            contest: {
                required: true,
                type: Object,
            }
        },

        created() {
            Dinero.globalFormat = '$0,0';
            Dinero.globalLocale = 'nl';
            Dinero.defaultCurrency = 'EUR';
        },

        methods: {
            submit() {
                axios.post('/checkouts', this.data).then((response) => {
                    this.stripe.redirectToCheckout({ sessionId: response.data }).then((result) => {
                        console.log(result.error);
                    });
                }).catch((error) => {
                    console.log(error.response.data.errors);
                });
            },
        },

        computed: {
            ...mapGetters('authentication', [
                'user',
            ]),

            data() {
                return {
                    amount: this.amount,
                    contest_id: this.contest.id,
                    email: this.user.email,
                    name: this.contest.name,
                };
            },

            amount() {
                return this.total.getAmount();
            },

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
