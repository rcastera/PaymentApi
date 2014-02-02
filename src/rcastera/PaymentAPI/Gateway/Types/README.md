What is a payment gateway?
================

A payment gateway is an e-commerce application service provider service that authorizes credit
card payments for e-businesses, online retailers, bricks and clicks, or traditional brick and mortar.

It is the equivalent of a physical point of sale terminal located in most retail outlets. Payment
gateways protect credit card details by encrypting sensitive information, such as credit card
numbers, to ensure that information is passed securely between the customer and the merchant and
also between merchant and the payment processor.

A payment gateway facilitates the transfer of information between a payment portal (such as a website,
mobile phone or interactive voice response service) and the Front End Processor or acquiring bank.
[(source)](http://en.wikipedia.org/wiki/Payment_gateway)


### Supported gateways
-----------------

| Gateway                                                     | API's            | Description                                      |
| ----------------------------------------------------------- | ---------------- | ------------------------------------------------ |
| [Authorize.net](Authorize/README.md)                        | AIM, ARB         | Single Payments and Recurring Billing            |
| [PayPal Payments Pro (Payflow Edition)](Paypal/README.md)   | Payflow          | Single Payments and Recurring Billing            |
| [Stripe](Stripe/README.md)                                  | Charge           | Single Payments                                  |


### Writing your own driver
-----------------
There are many more payment gateways that can be added. We encourage you to write your own; when
you encounter a gateway not supported, you can implement your own and contribute to this repo.

Here is how you get started:

Coming soon!
