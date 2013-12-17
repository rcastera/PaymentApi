<?php
namespace tests\rcastera\PaymentAPI\Gateway\Types\Stripe;

use rcastera\PaymentAPI\Gateway\Types\Stripe\Charge;
use rcastera\PaymentAPI\Exception\PaymentException;

class ChargeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var rcastera\PaymentAPI\Gateway\Types\Stripe\Charge
     */
    private $charge;

    /**
     * Setup.
     */
    public function setup()
    {
        $this->charge = new Charge();
    }

    /**
     * Destroy.
     */
    public function teardown()
    {
        unset($this->charge);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Stripe\Charge::setEndpoint
     * @covers rcastera\PaymentAPI\Gateway\Types\Stripe\Charge::getEndpoint
     */
    public function testSetEndpoint()
    {
        $this->charge->setEndpoint('http://www.google.com');
        $endpoint = $this->charge->getEndpoint();
        $this->assertEquals('http://www.google.com', $endpoint);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Stripe\Charge::setField
     */
    public function testSetField()
    {
        $this->charge->setField('testkey', 'testvalue');
        $field = $this->charge->getField('testkey');
        $this->assertEquals('testvalue', $field);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Stripe\Charge::setField
     * @covers rcastera\PaymentAPI\Gateway\Types\Stripe\Charge::getField
     */
    public function testGetField()
    {
        $this->charge->setField('testkey', 'testvalue');
        $field = $this->charge->getField('testkey');
        $this->assertEquals('testvalue', $field);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Stripe\Charge::getField
     */
    public function testGetFieldNullKey()
    {
        $this->charge->setField('testkey', 'testvalue');
        $field = $this->charge->getField('testkeys');
        $this->assertEquals(null, $field);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Stripe\Charge::getFields
     */
    public function testGetFields()
    {
        $this->charge->setField('testkey', 'testvalue');
        $field = $this->charge->getField('testkey');
        $this->assertEquals('testvalue', $field);

        $fields = $this->charge->getFields();
        $this->assertArrayHasKey('testkey', $fields);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Stripe\Charge::addHeader
     * @covers rcastera\PaymentAPI\Gateway\Types\Stripe\Charge::getHeaders
     */
    public function testAddHeader()
    {
        $this->charge->addHeader('Content-Type', 'text/namevalue');
        $headers = $this->charge->getHeaders();
        $this->assertArrayHasKey('Content-Type', $headers);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Stripe\Charge::processPayment
     */
    public function testProcessPayment()
    {
        $this->charge->setEndpoint('http://www.google.com');
        $this->charge->setField('testkey', 'testvalue');
        $this->charge->addHeader('Content-Type', 'text/namevalue');
        $this->charge->processPayment($this->charge->getEndpoint(), $this->charge->getFields(), $this->charge->getHeaders());
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Stripe\Charge::processPayment
     */
    public function testProcessPaymentNoEndpointException()
    {
        try {
            $this->charge->setEndpoint('');
            $this->charge->setField('testkey', 'testvalue');

            $this->charge->processPayment($this->charge->getEndpoint(), $this->charge->getFields(), $this->charge->getHeaders());
        } catch (PaymentException $e) {
            $this->assertTrue($e instanceof PaymentException);
        }
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Stripe\Charge::getResponse
     */
    public function testGetResponse()
    {
        $response = $this->charge->getResponse();
        $this->assertEmpty($response);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Stripe\Charge::debug
     */
    public function testDebug()
    {
        $debug = $this->charge->debug();
        $this->assertArrayHasKey('data', $debug);
    }
}
