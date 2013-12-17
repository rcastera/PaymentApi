<?php
namespace rcastera\PaymentAPI\Gateway\Types\Authorize;

use rcastera\PaymentAPI\Gateway\iPaymentGateway;
use rcastera\PaymentAPI\Gateway\Processor\PaymentProcessor;

class Aim extends PaymentProcessor implements iPaymentGateway
{
    /**
     * The endpoint url for the gateway.
     * @var string
     */
    private $url;

    /**
     * The data for submitting a transaction.
     * @var array
     */
    private $data = array();

    /**
     * Headers to send to gateway.
     * @var array
     */
    private $headers = array();

    /**
     * Sets the endpoint url for the gateway.
     *
     * @param string $url
     */
    public function setEndpoint($url)
    {
        $this->url = trim($url);
    }

    /**
     * Sets the endpoint url for the gateway.
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->url;
    }

    /**
     * Set merchant-defined fields to submit to gateway.
     *
     * @param string $name
     * @param string $value
     */
    public function setField($name = '', $value = '')
    {
        $field = array(
            $name => $value
        );

        $this->data = array_merge($this->data, $field);
    }

    /**
     * Get merchant-defined fields.
     *
     * @param $name
     * @return mixed
     */
    public function getField($name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }

        return null;
    }

    /**
     * Get merchant-defined fields.
     *
     * @param $name
     * @return mixed
     */
    public function getFields()
    {
        return $this->data;
    }

    /**
     * Set headers to submit to gateway.
     *
     * @param string $name
     * @param string $value
     */
    public function addHeader($name = '', $value = '')
    {
        $header = array(
            $name => $value
        );

        $this->headers = array_merge($this->headers, $header);
    }

    /**
     * Get headers to submit to gateway.
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Sends the request to gateway for processing.
     */
    public function processPayment()
    {
        $this->post($this->getEndpoint(), $this->getFields());
    }

    /**
     * Gets the response from the gateway.
     *
     * @param string $format.
     * @return array
     */
    public function getResponse()
    {
        return $this->response();
    }

    /**
     * Used to debug values that will be sent to gateway.
     *
     * @return array
     */
    public function debug()
    {
        return array(
            'data' => $this->getFields(),
            'headers' => $this->getHeaders()
        );
    }
}
