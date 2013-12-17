<?php
namespace tests\rcastera\PaymentAPI\Factory;

use rcastera\PaymentAPI\Factory\PaymentFactory;
use rcastera\PaymentAPI\Exception\PaymentException;

class PaymentFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers rcastera\PaymentAPI\Factory\PaymentFactory::get
     */
    public function testGet()
    {
        $payflow = PaymentFactory::get('Paypal.Payflow');
        $this->assertInstanceOf('rcastera\PaymentAPI\Gateway\Types\Paypal\PayFlow', $payflow);
    }

    /**
     * @covers rcastera\PaymentAPI\Factory\PaymentFactory::get
     */
    public function testGetEmptyType()
    {
        try {
            $payflow = PaymentFactory::get('');
        } catch (PaymentException $e) {
            $this->assertInstanceOf('rcastera\PaymentAPI\Exception\PaymentException', $e);
            $this->assertEquals('No payment type specified.', $e->getMessage());
        }
    }

    /**
     * @covers rcastera\PaymentAPI\Factory\PaymentFactory::get
     */
    public function testGetInvalidClass()
    {
        try {
            $payflow = PaymentFactory::get('Authorize.Aims');
        } catch (PaymentException $e) {
            $this->assertInstanceOf('rcastera\PaymentAPI\Exception\PaymentException', $e);
            $this->assertEquals('Not a valid payment gateway: Aims', $e->getMessage());
        }
    }
}
