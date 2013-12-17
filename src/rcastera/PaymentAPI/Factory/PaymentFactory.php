<?php
namespace rcastera\PaymentAPI\Factory;
use rcastera\PaymentAPI\Exception\PaymentException;

class PaymentFactory
{
    /**
     * Factory method to return new payment gateway.
     *
     * @param string
     * @return new PaymentGateway
     */
    public static function get($type = '')
    {
        if (empty($type)) {
            throw new PaymentException('No payment type specified.');
        }

        list($gateway, $type) = explode('.', $type);
        $gateway = "rcastera\\PaymentAPI\\Gateway\\Types\\$gateway\\" . $type;

        if (! class_exists($gateway)) {
            throw new PaymentException('Not a valid payment gateway: ' . $type);
        }

        return new $gateway;
    }
}
