Stripe
================

Stripe is the easiest way to accept credit and debit card payments online. With Stripe, you can create
exactly the payment experience you want in your website or mobile app, and they handle everything from
security to daily transfers to your bank account.

You don't need a merchant account or gateway. Stripe handles everything, including storing cards,
subscriptions, and direct payouts to your bank account.


### Documentation
-----------------
[Stripe's Documentation](https://stripe.com/docs/api).


### Transaction Types
- [Single payments](#single)


<a name="single"></a>
### Single Transaction example
-----------------
```php
require 'vendor/autoload.php';

use rcastera\PaymentAPI\Factory\PaymentFactory;
use rcastera\PaymentAPI\Exception\PaymentException;
use rcastera\PaymentAPI\Util\PaymentUtil;

$stripe = PaymentFactory::get('Stripe.Charge');

// Login and transaction configuration.
$stripe->setEndpoint('https://api.stripe.com/v1/charges');
$stripe->addHeader('Authorization', 'Bearer YOUR_SECRET_KEY');

// CC information.
$stripe->setField('amount', 25);
$stripe->setField('currency', 'usd');
$stripe->setField('description', 'Richard purchased product #10034');
$stripe->setField('card', array(
    'number' =>'4242424242424242',
    'exp_month' => '5',
    'exp_year' => '2015',
    'cvc' => '123'
));

print_r($stripe->debug());

try {
    $stripe->processPayment();
    print_r($stripe->getResponse());
} catch (PaymentException $e) {
    echo $e->getMessage();
}
```
