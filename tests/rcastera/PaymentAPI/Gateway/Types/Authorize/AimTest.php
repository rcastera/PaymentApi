<?php
namespace tests\rcastera\PaymentAPI\Gateway\Types\Authorize;

use rcastera\PaymentAPI\Gateway\Types\Authorize\Aim;
use rcastera\PaymentAPI\Exception\PaymentException;

class AimTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var rcastera\PaymentAPI\Gateway\Types\Authorize\Aim
     */
    private $aim;

    /**
     * Setup.
     */
    public function setup()
    {
        $this->aim = new Aim();
    }

    /**
     * Destroy.
     */
    public function teardown()
    {
        unset($this->aim);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Aim::setEndpoint
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Aim::getEndpoint
     */
    public function testSetEndpoint()
    {
        $this->aim->setEndpoint('http://www.google.com');
        $endpoint = $this->aim->getEndpoint();
        $this->assertEquals('http://www.google.com', $endpoint);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Aim::setField
     */
    public function testSetField()
    {
        $this->aim->setField('testkey', 'testvalue');
        $field = $this->aim->getField('testkey');
        $this->assertEquals('testvalue', $field);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Aim::setField
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Aim::getField
     */
    public function testGetField()
    {
        $this->aim->setField('testkey', 'testvalue');
        $field = $this->aim->getField('testkey');
        $this->assertEquals('testvalue', $field);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Aim::getField
     */
    public function testGetFieldNullKey()
    {
        $this->aim->setField('testkey', 'testvalue');
        $field = $this->aim->getField('testkeys');
        $this->assertEquals(null, $field);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Aim::getFields
     */
    public function testGetFields()
    {
        $this->aim->setField('testkey', 'testvalue');
        $field = $this->aim->getField('testkey');
        $this->assertEquals('testvalue', $field);

        $fields = $this->aim->getFields();
        $this->assertArrayHasKey('testkey', $fields);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Aim::addHeader
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Aim::getHeaders
     */
    public function testAddHeader()
    {
        $this->aim->addHeader('Content-Type', 'text/namevalue');
        $headers = $this->aim->getHeaders();
        $this->assertArrayHasKey('Content-Type', $headers);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Aim::processPayment
     */
    public function testProcessPayment()
    {
        $this->aim->setEndpoint('http://www.google.com');
        $this->aim->setField('testkey', 'testvalue');
        $this->aim->processPayment($this->aim->getEndpoint(), $this->aim->getFields());
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Aim::processPayment
     */
    public function testProcessPaymentNoEndpointException()
    {
        try {
            $this->aim->setEndpoint('');
            $this->aim->setField('testkey', 'testvalue');

            $this->aim->processPayment($this->aim->getEndpoint(), $this->aim->getFields());
        } catch (PaymentException $e) {
            $this->assertTrue($e instanceof PaymentException);
        }
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Aim::getResponse
     */
    public function testGetResponse()
    {
        $response = $this->aim->getResponse();
        $this->assertEmpty($response);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Aim::debug
     */
    public function testDebug()
    {
        $debug = $this->aim->debug();
        $this->assertArrayHasKey('data', $debug);
    }
}
