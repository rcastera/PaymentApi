Authorize.net
================

Since 1996, Authorize.Net has been a leading provider of payment gateway services,
managing the submission of billions of transactions to the processing networks on
behalf of merchant customers. Authorize.Net is a solution of CyberSource
Corporation, a wholly owned subsidiary of Visa (NYSE: V).


### Documentation
-----------------
- [Authroize.net (AIM)](http://www.authorize.net/support/AIM_guide.pdf)
- [Authroize.net Recurring Billing (ARB)](http://www.authorize.net/support/ARB_guide.pdf)


### Transaction Types
- [Single payments (AIM)](#single)
- [Recurring billing (ARB)](#recurring)


<a name="single"></a>
### Single Transaction example
-----------------
```php
require 'vendor/autoload.php';

use rcastera\PaymentAPI\Factory\PaymentFactory;
use rcastera\PaymentAPI\Exception\PaymentException;
use rcastera\PaymentAPI\Util\PaymentUtil;

$authorize = PaymentFactory::get('Authorize.Aim');

// Login and transaction configuration.
$authorize->setEndpoint('https://secure.authorize.net/gateway/transact.dll');
$authorize->setField('x_delim_data', 'true');
$authorize->setField('x_delim_char', '|');
$authorize->setField('x_relay_response', 'false');
$authorize->setField('x_login', 'YOUR_LOGIN');
$authorize->setField('x_tran_key', 'YOUR_TRANS_KEY');
$authorize->setField('x_type', 'AUTH_CAPTURE');
$authorize->setField('x_method', 'CC');
$authorize->setField('x_customer_ip', PaymentUtil::getIpAddress());

// CC information.
$authorize->setField('x_amount', 33.99);
$authorize->setField('x_card_num', '378282246310005');
$authorize->setField('x_exp_date', '11/15');
$authorize->setField('x_card_code', '4685');
$authorize->setField('x_description', 'Richard purchased product #10034');

// Customer information.
$authorize->setField('x_first_name', 'Richard');
$authorize->setField('x_last_name', 'Castera');
$authorize->setField('x_company', 'ShiftingIdeas');
$authorize->setField('x_address', '123 Sunrise Rd.');
$authorize->setField('x_city', 'New York');
$authorize->setField('x_state', 'NY');
$authorize->setField('x_zip', '10013');
$authorize->setField('x_country', 'US');
$authorize->setField('x_phone', '212-333-4444');
$authorize->setField('x_fax', '212-333-4445');
$authorize->setField('x_email', 'youremail@gmail.com');
print_r($authorize->debug());

try {
    $authorize->processPayment();
    print_r($authorize->getResponse());
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

$authorize = PaymentFactory::get('Authorize.Arb');

// Login and transaction configuration.
$authorize->setEndpoint('https://api.authorize.net/xml/v1/request.api');
$authorize->addHeader('Content-Type', 'text/xml');
$authorize->setField('merchantAuthentication_name', 'YOUR_LOGIN');
$authorize->setField('merchantAuthentication_transactionKey', 'YOUR_TRANS_KEY');
$authorize->setField('refId', 'Sample');

// Payment information.
$authorize->setField('subscriptionName', 'Sample subscription');
$authorize->setField('intervalLength', 1);
$authorize->setField('intervalUnit', 'months');
$authorize->setField('startDate', date('Y-m-d'));
$authorize->setField('totalOccurrences', 12);
$authorize->setField('trialOccurrences', 1);

// CC information.
$authorize->setField('amount', 10.29);
$authorize->setField('trialAmount', 0.00);
$authorize->setField('creditCardCardNumber', '378282246310005');
$authorize->setField('creditCardExpirationDate', '2015-08');
$authorize->setField('creditCardCardCode', '4685');

// Bank info.
$authorize->setField('bankAccountType', 'checking');
$authorize->setField('bankAccountRoutingNumber', '021133333');
$authorize->setField('bankAccountAccountNumber', '403434333333');
$authorize->setField('bankAccountNameOnAccount', 'John Smith');
$authorize->setField('bankAccountEcheckType', 'PPD');
$authorize->setField('bankAccountBankName', 'Chase');

// Order info.
$authorize->setField('invoiceNumber', '000000001');
$authorize->setField('description', 'Another payment.');

// Customer information.
$authorize->setField('customerId', '32545440000');
$authorize->setField('customerEmail', 'customer_email@gmail.com');
$authorize->setField('customerPhoneNumber', '212-222-2222');
$authorize->setField('customerFaxNumber', '212-222-2223');

// Bill to
$authorize->setField('billToFirstName', 'John');
$authorize->setField('billToLastName', 'Smith');
$authorize->setField('billToCompany', 'My Company');
$authorize->setField('billToAddress', '123 Sprint St.');
$authorize->setField('billToCity', 'NY');
$authorize->setField('billToState', 'NY');
$authorize->setField('billToZip', '10022');
$authorize->setField('billToCountry', 'US');

// Ship to
$authorize->setField('shipToFirstName', 'John');
$authorize->setField('shipToLastName', 'Smith');
$authorize->setField('shipToCompany', 'My Company');
$authorize->setField('shipToAddress', '123 Sprint St.');
$authorize->setField('shipToCity', 'NY');
$authorize->setField('shipToState', 'NY');
$authorize->setField('shipToZip', '10022');
$authorize->setField('shipToCountry', 'US');
print_r($authorize->debug());

try {
    $authorize->processPayment();
    print_r($authorize->getResponse());
} catch (PaymentException $e) {
    echo $e->getMessage();
}
```
