<?php
namespace rcastera\PaymentAPI\Gateway\Processor;

use rcastera\PaymentAPI\Exception\PaymentException;
use Guzzle\Http\Client;
use Guzzle\Http\Message\Response;

class PaymentProcessor
{
    /**
     * The response from the gateway.
     * @var array
     */
    private $response = array();

    /**
     * Sends a post to the gateway.
     *
     * @param string $url
     * @param array $data
     * @param array $headers
     */
    public function post($url = '', $data = '', $headers = array())
    {
        if (empty($url)) {
            throw new PaymentException('No endpoint for gateway defined.');
        }

        try {
            $client = new Client();
            $request = $client->post($url, $headers, $data);
            $response = $request->send();
            $this->setResponse($response);
        } catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {
            $this->setResponse($e->getResponse());
        } catch (\Guzzle\Http\Exception\ServerErrorResponseException $e) {
            $this->setResponse($e->getResponse());
        } catch (\Guzzle\Http\Exception\BadResponseException $e) {
            $this->setResponse($e->getResponse());
        } catch (\Exception $e) {
            throw new PaymentException($e->getMessage());
        }
    }

    /**
     * Set the response.
     *
     * @param Response $response
     */
    public function setResponse(Response $response)
    {
        $this->response['response'] = (string) trim($response->getBody());
        $this->response['status'] = $response->getStatusCode();
        $this->response['reason'] = $response->getReasonPhrase();
    }

    /**
     * Returns the response from the gateway.
     *
     * @return array
     */
    public function response()
    {
        return $this->response;
    }
}
