Paypal Payflow
================

Payflow is secure, open payment gateway. Payflow allows merchants to choose any Internet Merchant Account to
accept debit or credit card payments and connect to any major processor. It also lets merchants
accept PayPal and Bill Me Later payments.


### Documentation
-----------------
- [Paypal Payflow](https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/payflowgateway_guide.pdf)
- [Paypal Payflow Recurring Billing](https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/pp_payflowpro_recurringbilling_guide.pdf)


### Transaction Types
- [Single payments](#single)
- [Recurring billing](#recurring)


<a name="single"></a>
### Single Transaction example
-----------------
```php
require 'vendor/autoload.php';

use rcastera\PaymentAPI\Factory\PaymentFactory;
use rcastera\PaymentAPI\Exception\PaymentException;
use rcastera\PaymentAPI\Util\PaymentUtil;

$payflow = PaymentFactory::get('Paypal.Payflow');

// Login and transaction configuration.
$payflow->setEndpoint('https://payflowpro.paypal.com');
$payflow->setField('VENDOR', 'YOUR_VENDOR');
$payflow->setField('PARTNER', 'PARTNER');
$payflow->setField('USER', 'YOUR_USER');
$payflow->setField('PWD', 'YOUR_PASSWORD');
$payflow->setField('CUSTIP', PaymentUtil::getIpAddress());
$payflow->setField('VERBOSITY', 'M');
$payflow->setField('TRXTYPE', 'S');
$payflow->setField('TENDER', 'C');
$payflow->setField('CURRENCY', 'USD');

// CC information.
$payflow->setField('NAME', 'Richard Castera');
$payflow->setField('AMT', 13);
$payflow->setField('ACCT', '378282246310005');
$payflow->setField('EXPDATE', '1115');
$payflow->setField('CVV2', '4685');
$payflow->setField('COMMENT1', 'Richard purchased product #10034');

// Customer information.
$payflow->setField('FIRSTNAME', 'Richard');
$payflow->setField('LASTNAME', 'Castera');
$payflow->setField('STREET', '123 Sunrise Rd.');
$payflow->setField('CITY', 'New York');
$payflow->setField('STATE', 'NY');
$payflow->setField('ZIP', '10013');
$payflow->setField('COUNTRY', 'US');
$payflow->setField('PHONENUM', '212-333-4444');
$payflow->setField('EMAIL', 'youremail@gmail.com');
print_r($payflow->debug());

try {
    $payflow->processPayment();
    print_r($payflow->getResponse());
} catch (PaymentException $e) {
    echo $e->getMessage();
}
```


<a name="recurring"></a>
### Recurring Transaction example
-----------------
```php
require 'vendor/autoload.php';

use rcastera\PaymentAPI\Factory\PaymentFactory;
use rcastera\PaymentAPI\Exception\PaymentException;
use rcastera\PaymentAPI\Util\PaymentUtil;

$payflow = PaymentFactory::get('Paypal.Payflow');

// Login and transaction configuration.
$payflow->setEndpoint('https://payflowpro.paypal.com');
$payflow->setField('VENDOR', 'YOUR_VENDOR');
$payflow->setField('PARTNER', 'PARTNER');
$payflow->setField('USER', 'YOUR_USER');
$payflow->setField('PWD', 'YOUR_PASSWORD');
$payflow->setField('CUSTIP', PaymentUtil::getIpAddress());
$payflow->setField('VERBOSITY', 'M');
$payflow->setField('TENDER', 'C');
$payflow->setField('CURRENCY', 'USD');

// Recurring values.
$payflow->setField('TRXTYPE', 'R');
$payflow->setField('ACTION', 'A');
$payflow->setField('PROFILENAME', 'RecurringTransaction');
$payflow->setField('START', date('mdY', strtotime('+1 day')));
$payflow->setField('PAYPERIOD', 'MONT');
$payflow->setField('TERM', 0);

// CC information.
$payflow->setField('NAME', 'Richard Castera');
$payflow->setField('AMT', 50);
$payflow->setField('ACCT', '378282246310005');
$payflow->setField('EXPDATE', '11/15');
$payflow->setField('CVV2', '4685');
$payflow->setField('COMMENT1', 'Richard purchased product #10034');

// Customer information.
$payflow->setField('FIRSTNAME', 'Richard');
$payflow->setField('LASTNAME', 'Castera');
$payflow->setField('STREET', '123 Sunrise Rd.');
$payflow->setField('CITY', 'New York');
$payflow->setField('STATE', 'NY');
$payflow->setField('ZIP', '10013');
$payflow->setField('COUNTRY', 'US');
$payflow->setField('PHONENUM', '212-333-4444');
$payflow->setField('EMAIL', 'youremail@gmail.com');
print_r($payflow->debug());

try {
    $payflow->processPayment();
    print_r($payflow->getResponse());
} catch (PaymentException $e) {
    echo $e->getMessage();
}
```