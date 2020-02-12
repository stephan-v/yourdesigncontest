<template>
    <form @submit.prevent>
        <div class="form-group mb-3">
            <label for="currency">Currency</label>
            <select name="currency" class="form-control" id="currency" v-model="currency">
                <option value="eur">EUR</option>
                <option value="usd">USD</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="amount">Price money</label>
            <input type="number"
                   class="form-control"
                   id="amount"
                   :placeholder="placeholder"
                   v-model.number="amount">
            <small class="form-text text-muted">Select how much the winning designer will earn.</small>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Order details</h5>

                <ul class="total-price list-unstyled">
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

        <div class="alert alert-danger" v-if="errors.length">
            <ul class="mb-0 list-unstyled">
                <li v-for="error in errors" :key="error">{{ error }}</li>
            </ul>
        </div>

        <button type="submit" class="btn btn-primary" @click="submit">Continue to checkout</button>
    </form>
</template>

<script>
    import Dinero from 'dinero.js';

    export default {
        data() {
            return {
                amount: null,
                currency: 'eur',
                rawErrors: [],
                stripe: Stripe('pk_test_xS6i7CE8EvKafYNJijLGchad'),
                percentage: 10,
            };
        },

        props: {
            contest: {
                required: true,
                type: Object,
            },
        },

        created() {
            Dinero.globalFormat = '$0,0';
            Dinero.globalLocale = 'en';
        },

        methods: {
            submit() {
                axios.post(`/contests/${this.contest.id}/checkout`, this.data).then((response) => {
                    this.stripe.redirectToCheckout({ sessionId: response.data }).then((result) => {
                        console.log(result.error);
                    });
                }).catch((error) => {
                    this.rawErrors = error.response.data.errors;
                });
            },
        },

        computed: {
            user() {
                return this.$store.getters['authentication/user'];
            },

            errors() {
                return Object.values(this.rawErrors).flat();
            },

            data() {
                return {
                    amount: this.total.getAmount(),
                    currency: this.currency,
                    email: this.user.email,
                    name: this.contest.name,
                };
            },

            price() {
                return Dinero({
                    amount: (this.amount * 100 || 0),
                    currency: this.currency,
                });
            },

            fee() {
                return this.price.percentage(this.percentage);
            },

            total() {
                return this.price.add(this.fee);
            },

            placeholder() {
                return `Amount in ${this.currency.toUpperCase()}`;
            },
        },
    };
</script>

<style lang="scss" scoped>
    ul {
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
