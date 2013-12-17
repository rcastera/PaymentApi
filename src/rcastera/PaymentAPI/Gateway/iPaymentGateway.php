<?php
namespace rcastera\PaymentAPI\Gateway;

interface iPaymentGateway
{
    /**
     * Sets the endpoint url for the gateway.
     *
     * @param string $url
     */
    public function setEndpoint($url);

    /**
     * Gets the endpoint url for the gateway.
     *
     * @return string
     */
    public function getEndpoint();

    /**
     * Set merchant-defined fields to submit to gateway.
     *
     * @param string $name
     * @param string $value
     */
    public function setField($name, $value);

    /**
     * Get merchant-defined fields.
     *
     * @param string $name
     * @return mixed
     */
    public function getField($name);

    /**
     * Get all merchant-defined fields.
     *
     * @return array
     */
    public function getFields();

    /**
     * Set headers to submit to gateway.
     *
     * @param string $name
     * @param string $value
     */
    public function addHeader($name, $value);

    /**
     * Gets headers to submit to gateway.
     *
     * @return array
     */
    public function getHeaders();

    /**
     * Sends the request to gateway for processing.
     */
    public function processPayment();

    /**
     * Gets the response from the gateway.
     *
     * @param string $format
     * @return array
     */
    public function getResponse();

    /**
     * Used to debug values that will be sent to gateway.
     *
     * @return the data.
     */
    public function debug();
}
