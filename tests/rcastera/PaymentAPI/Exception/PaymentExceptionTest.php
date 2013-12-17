<?php
namespace tests\rcastera\PaymentAPI\Exception;

use rcastera\PaymentAPI\Exception\PaymentException;

class PaymentExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testPaymentException()
    {
        try {
            throw new PaymentException('Error Processing Request', 1);
        } catch (PaymentException $e) {
            $this->assertTrue($e instanceof PaymentException);
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }
}
