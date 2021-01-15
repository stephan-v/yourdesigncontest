### Payments

The payment provider [Stripe](https://stripe.com/) is used to process all incoming payments.

#### Stripe Webhook

To test Stripe locally, the applications needs to be able to receive webhook requests from Stripe. This can be achieved
with the following command:

```
valet share --region=eu -subdomain=yourdesigncontest
```

Due to restrictions which prohibit funds from being transferred between EU and US Stripe accounts Stripe connect
cannot be used.

Therefore, Stripe payouts are transferred into a [TransferWise](https://transferwise.com/) accounts which makes it easier to accept payments from
around the globe and allows for cheap payouts. 
