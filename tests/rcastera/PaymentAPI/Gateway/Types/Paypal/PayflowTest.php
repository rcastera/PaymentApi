<?php
namespace tests\rcastera\PaymentAPI\Gateway\Types\Paypal;

use rcastera\PaymentAPI\Gateway\Types\Paypal\Payflow;
use rcastera\PaymentAPI\Exception\PaymentException;

class PayflowTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var rcastera\PaymentAPI\Gateway\Types\Paypal\Payflow
     */
    private $payflow;

    /**
     * Setup.
     */
    public function setup()
    {
        $this->payflow = new Payflow();
    }

    /**
     * Destroy.
     */
    public function teardown()
    {
        unset($this->payflow);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Paypal\Payflow::setEndpoint
     * @covers rcastera\PaymentAPI\Gateway\Types\Paypal\Payflow::getEndpoint
     */
    public function testSetEndpoint()
    {
        $this->payflow->setEndpoint('http://www.google.com');
        $endpoint = $this->payflow->getEndpoint();
        $this->assertEquals('http://www.google.com', $endpoint);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Paypal\Payflow::setField
     */
    public function testSetField()
    {
        $this->payflow->setField('testkey', 'testvalue');
        $field = $this->payflow->getField('testkey');
        $this->assertEquals('testvalue', $field);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Paypal\Payflow::setField
     * @covers rcastera\PaymentAPI\Gateway\Types\Paypal\Payflow::getField
     */
    public function testGetField()
    {
        $this->payflow->setField('testkey', 'testvalue');
        $field = $this->payflow->getField('testkey');
        $this->assertEquals('testvalue', $field);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Paypal\Payflow::getField
     */
    public function testGetFieldNullKey()
    {
        $this->payflow->setField('testkey', 'testvalue');
        $field = $this->payflow->getField('testkeys');
        $this->assertEquals(null, $field);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Paypal\Payflow::getFields
     */
    public function testGetFields()
    {
        $this->payflow->setField('testkey', 'testvalue');
        $field = $this->payflow->getField('testkey');
        $this->assertEquals('testvalue', $field);

        $fields = $this->payflow->getFields();
        $this->assertArrayHasKey('testkey', $fields);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Paypal\Payflow::addHeader
     * @covers rcastera\PaymentAPI\Gateway\Types\Paypal\Payflow::getHeaders
     */
    public function testAddHeader()
    {
        $this->payflow->addHeader('Content-Type', 'text/namevalue');
        $headers = $this->payflow->getHeaders();
        $this->assertArrayHasKey('Content-Type', $headers);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Paypal\Payflow::processPayment
     */
    public function testProcessPayment()
    {
        $this->payflow->setEndpoint('http://www.google.com');
        $this->payflow->setField('testkey', 'testvalue');
        $this->payflow->addHeader('Content-Type', 'text/namevalue');
        $this->payflow->processPayment($this->payflow->getEndpoint(), $this->payflow->getFields(), $this->payflow->getHeaders());
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Paypal\Payflow::processPayment
     */
    public function testProcessPaymentNoEndpointException()
    {
        try {
            $this->payflow->setEndpoint('');
            $this->payflow->setField('testkey', 'testvalue');

            $this->payflow->processPayment($this->payflow->getEndpoint(), $this->payflow->getFields(), $this->payflow->getHeaders());
        } catch (PaymentException $e) {
            $this->assertTrue($e instanceof PaymentException);
        }
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Paypal\Payflow::getResponse
     */
    public function testGetResponse()
    {
        $response = $this->payflow->getResponse();
        $this->assertEmpty($response);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Paypal\Payflow::debug
     */
    public function testDebug()
    {
        $debug = $this->payflow->debug();
        $this->assertArrayHasKey('data', $debug);
    }
}
