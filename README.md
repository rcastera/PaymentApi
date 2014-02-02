PaymentAPI
================

The PaymentAPI allows you to easily process e-commerce transactions without
having to worry about all the backend details of connecting and setting up
the cURL options.

- An extremely easy API.
- Extensible to add many different payment gateways.
- Consumes gateway api's using the [Guzzle client](http://guzzlephp.org/).

### Supported gateways
-----------------
There are several gateways ([Stripe](src/rcastera/PaymentAPI/Gateway/Types/Stripe/README.md), [Authorize.net](src/rcastera/PaymentAPI/Gateway/Types/Authorize/README.md) and [Paypal](src/rcastera/PaymentAPI/Gateway/Types/Paypal/README.md) to name a few) and more will be added but, if you need one that isn't supported yet, feel free to contribute.
[See supported gateways.](src/rcastera/PaymentAPI/Gateway/Types/README.md)

### Setup
-----------------
 Add a `composer.json` file to your project:

```javascript
{
  "require": {
      "rcastera/payment-api": "v1.0.0"
  }
}
```

Then provided you have [composer](http://getcomposer.org) installed, you can run the following command:

```bash
$ composer.phar install
```

That will fetch the library and its dependencies inside your vendor folder. Then you can add the following to your
.php files in order to use the library (if you don't already have one).

```php
require 'vendor/autoload.php';
```

Then you need to `use` the relevant class, and instantiate the gateway.

### Example
-----------------
```php
require 'vendor/autoload.php';

use rcastera\PaymentAPI\Factory\PaymentFactory;
use rcastera\PaymentAPI\Exception\PaymentException;
use rcastera\PaymentApi\Util\PaymentUtil;

$authorize = PaymentFactory::get('Authorize.Aim');

```

### Utility class
-----------------
There's a utility class that's included for convenince.
[Learn more about the Utility class](src/rcastera/PaymentAPI/Util/README.md)

### Contributing
-----------------
1. Fork it.
2. Create a branch (`git checkout -b my_branch`)
3. Commit your changes (`git commit -am "Added something"`)
4. Push to the branch (`git push origin my_branch`)
5. Create an Issue with a link to your branch
6. Enjoy a refreshing Coke and wait
