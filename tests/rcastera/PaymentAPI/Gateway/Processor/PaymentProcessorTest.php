<?php
namespace tests\rcastera\PaymentAPI\Gateway\Processor;

use rcastera\PaymentAPI\Gateway\Processor\PaymentProcessor;
use rcastera\PaymentAPI\Exception\PaymentException;
use Guzzle\Http\Client;
use Guzzle\Http\Message\Response;

class PaymentProcessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers rcastera\PaymentAPI\Gateway\Processor\PaymentProcessor::post
     */
    public function testPostEmptyUrl()
    {
        $paymentProcessor = new PaymentProcessor();

        try {
            $paymentProcessor->post();
        } catch (PaymentException $e) {
            $this->assertInstanceOf('rcastera\PaymentAPI\Exception\PaymentException', $e);
            $this->assertEquals('No endpoint for gateway defined.', $e->getMessage());
        }
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Processor\PaymentProcessor::post
     */
    public function testPost()
    {
        $paymentProcessor = new PaymentProcessor();
        $response = new Response(200);
        $response->setBody('Test message');

        $url = 'http://www.google.com';
        $data = array();
        $paymentProcessor->post($url, $data);
    }

    /**
     * @covers rcastera\PaymentAPI\Gateway\Processor\PaymentProcessor::setResponse
     * @covers rcastera\PaymentAPI\Gateway\Processor\PaymentProcessor::response
     */
    public function testSetResponse()
    {
        $paymentProcessor = new PaymentProcessor();
        $response = new Response(200);
        $response->setBody('Test message');

        $paymentProcessor->setResponse($response);
        $result = $paymentProcessor->response();

        $this->assertEquals($result['status'], $response->getStatusCode());
        $this->assertEquals($result['response'], $response->getBody());
        $this->assertEquals($result['reason'], $response->getReasonPhrase());
    }
}
