<?php
namespace tests\rcastera\PaymentAPI\Gateway\Types\Authorize;

use rcastera\PaymentAPI\Gateway\Types\Authorize\Arb;
use rcastera\PaymentAPI\Exception\PaymentException;

class ArbTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var rcastera\PaymentAPI\Gateway\Types\Authorize\Arb
     */
    private $arb;

    /**
     * Setup.
     */
    public function setup()
    {
        $this->arb = new Arb();
    }

    /**
     * Destroy.
     */
    public function teardown()
    {
        unset($this->arb);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::setEndpoint
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::getEndpoint
     */
    public function testSetEndpoint()
    {
        $this->arb->setEndpoint('http://www.google.com');
        $endpoint = $this->arb->getEndpoint();
        $this->assertEquals('http://www.google.com', $endpoint);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::setField
     */
    public function testSetField()
    {
        $this->arb->setField('subscriptionName', 'testvalue');
        $field = $this->arb->getField('subscriptionName');
        $this->assertEquals('testvalue', $field);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::setField
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::getField
     */
    public function testGetField()
    {
        $this->arb->setField('subscriptionName', 'testvalue');
        $field = $this->arb->getField('subscriptionName');
        $this->assertEquals('testvalue', $field);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::getField
     */
    public function testGetFieldNullKey()
    {
        $this->arb->setField('subscriptionName', 'testvalue');
        $field = $this->arb->getField('names');
        $this->assertEquals(null, $field);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::getFields
     */
    public function testGetFields()
    {
        $this->arb->setField('subscriptionName', 'testvalue');
        $field = $this->arb->getField('subscriptionName');
        $this->assertEquals('testvalue', $field);

        $fields = $this->arb->getFields();
        $this->assertTag(array(
            'tag' => 'ARBCreateSubscriptionRequest',
            'child' => array(
                'tag' => 'subscription',
                'child' => array(
                    'tag' => 'name',
                    'content' => $field
                )
            )
        ), $fields);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::getFields
     */
    public function testGetFieldsRefId()
    {
        $this->arb->setField('refId', 'testvalue');
        $field = $this->arb->getField('refId');
        $this->assertEquals('testvalue', $field);

        $fields = $this->arb->getFields();
        $this->assertTag(array(
            'tag' => 'ARBCreateSubscriptionRequest',
            'child' => array(
                'tag' => 'refId',
                'content' => $field
            )
        ), $fields);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::getFields
     */
    public function testGetFieldsTrialOccurrences()
    {
        $this->arb->setField('trialOccurrences', 'testvalue');
        $field = $this->arb->getField('trialOccurrences');
        $this->assertEquals('testvalue', $field);

        $fields = $this->arb->getFields();
        $this->assertTag(array(
            'tag' => 'ARBCreateSubscriptionRequest',
            'child' => array(
                'tag' => 'subscription',
                'child' => array(
                    'tag' => 'paymentSchedule',
                    'child' => array(
                        'tag' => 'trialOccurrences',
                        'content' => $field
                    )
                )
            )
        ), $fields);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::getFields
     */
    public function testGetFieldsTrialAmount()
    {
        $this->arb->setField('trialAmount', 'testvalue');
        $field = $this->arb->getField('trialAmount');
        $this->assertEquals('testvalue', $field);

        $fields = $this->arb->getFields();
        $this->assertTag(array(
            'tag' => 'ARBCreateSubscriptionRequest',
            'child' => array(
                'tag' => 'subscription',
                'child' => array(
                    'tag' => 'trialAmount',
                    'content' => $field
                )
            )
        ), $fields);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::getFields
     */
    public function testGetFieldsBankAccountType()
    {
        $this->arb->setField('bankAccountType', 'testvalue');
        $field = $this->arb->getField('bankAccountType');
        $this->assertEquals('testvalue', $field);

        $fields = $this->arb->getFields();
        $this->assertTag(array(
            'tag' => 'ARBCreateSubscriptionRequest',
            'child' => array(
                'tag' => 'subscription',
                'child' => array(
                    'tag' => 'payment',
                    'child' => array(
                        'tag' => 'bankAccount',
                        'child' => array(
                            'tag' => 'accountType',
                            'content' => $field
                        )
                    )
                )
            )
        ), $fields);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::getFields
     */
    public function testGetFieldsInvoiceNumber()
    {
        $this->arb->setField('invoiceNumber', 'testvalue');
        $field = $this->arb->getField('invoiceNumber');
        $this->assertEquals('testvalue', $field);

        $fields = $this->arb->getFields();
        $this->assertTag(array(
            'tag' => 'ARBCreateSubscriptionRequest',
            'child' => array(
                'tag' => 'subscription',
                'child' => array(
                    'tag' => 'order',
                    'child' => array(
                        'tag' => 'invoiceNumber',
                        'content' => $field
                    )
                )
            )
        ), $fields);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::getFields
     */
    public function testGetFieldsCustomerPhoneNumber()
    {
        $this->arb->setField('customerPhoneNumber', 'testvalue');
        $field = $this->arb->getField('customerPhoneNumber');
        $this->assertEquals('testvalue', $field);

        $fields = $this->arb->getFields();
        $this->assertTag(array(
            'tag' => 'ARBCreateSubscriptionRequest',
            'child' => array(
                'tag' => 'subscription',
                'child' => array(
                    'tag' => 'customer',
                    'child' => array(
                        'tag' => 'phoneNumber',
                        'content' => $field
                    )
                )
            )
        ), $fields);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::getFields
     */
    public function testGetFieldsBillToAddress()
    {
        $this->arb->setField('billToAddress', 'testvalue');
        $field = $this->arb->getField('billToAddress');
        $this->assertEquals('testvalue', $field);

        $fields = $this->arb->getFields();
        $this->assertTag(array(
            'tag' => 'ARBCreateSubscriptionRequest',
            'child' => array(
                'tag' => 'subscription',
                'child' => array(
                    'tag' => 'billTo',
                    'child' => array(
                        'tag' => 'address',
                        'content' => $field
                    )
                )
            )
        ), $fields);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::getFields
     */
    public function testGetFieldsShipToAddress()
    {
        $this->arb->setField('shipToAddress', 'testvalue');
        $field = $this->arb->getField('shipToAddress');
        $this->assertEquals('testvalue', $field);

        $fields = $this->arb->getFields();
        $this->assertTag(array(
            'tag' => 'ARBCreateSubscriptionRequest',
            'child' => array(
                'tag' => 'subscription',
                'child' => array(
                    'tag' => 'shipTo',
                    'child' => array(
                        'tag' => 'address',
                        'content' => $field
                    )
                )
            )
        ), $fields);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::addHeader
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::getHeaders
     */
    public function testAddHeader()
    {
        $this->arb->addHeader('Content-Type', 'text/namevalue');
        $headers = $this->arb->getHeaders();
        $this->assertArrayHasKey('Content-Type', $headers);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::processPayment
     */
    public function testProcessPayment()
    {
        $this->arb->setEndpoint('http://www.google.com');
        $this->arb->setField('testkey', 'testvalue');
        $this->arb->processPayment($this->arb->getEndpoint(), $this->arb->getFields());
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::processPayment
     */
    public function testProcessPaymentNoEndpointException()
    {
        try {
            $this->arb->setEndpoint('');
            $this->arb->setField('testkey', 'testvalue');

            $this->arb->processPayment($this->arb->getEndpoint(), $this->arb->getFields());
        } catch (PaymentException $e) {
            $this->assertTrue($e instanceof PaymentException);
        }
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::getResponse
     */
    public function testGetResponse()
    {
        $response = $this->arb->getResponse();
        $this->assertEmpty($response);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Types\Authorize\Arb::debug
     */
    public function testDebug()
    {
        $debug = $this->arb->debug();
        $this->assertArrayHasKey('data', $debug);
    }
}
