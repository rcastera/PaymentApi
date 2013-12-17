<?php
namespace rcastera\PaymentAPI\Gateway\Types\Authorize;

use rcastera\PaymentAPI\Gateway\iPaymentGateway;
use rcastera\PaymentAPI\Gateway\Processor\PaymentProcessor;
use \XMLWriter;

class Arb extends PaymentProcessor implements iPaymentGateway
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
        $writer = new XMLWriter();
        $writer->openMemory();
        $writer->setIndent(true);
        $writer->startDocument('1.0', 'utf-8');
            // <ARBCreateSubscriptionRequest>
            $writer->startElement('ARBCreateSubscriptionRequest');
            $writer->writeAttribute('xmlns', 'AnetApi/xml/v1/schema/AnetApiSchema.xsd');

                // <merchantAuthentication>
                $writer->startelement('merchantAuthentication');
                    $writer->writeElement('name', $this->getField('merchantAuthentication_name'));
                    $writer->writeElement('transactionKey', $this->getField('merchantAuthentication_transactionKey'));
                $writer->endElement();
                // </merchantAuthentication>

                // <refId>
                $refId = $this->getField('refId');
                if (! empty($refId)) {
                    $writer->writeElement('refId', $refId);
                }
                // </refId>

                // <subscription>
                $writer->startelement('subscription');
                    // <name>
                    $subscriptionName = $this->getField('subscriptionName');
                    if (! empty($subscriptionName)) {
                        $writer->writeElement('name', $subscriptionName);
                    }
                    // </name>

                    // <paymentSchedule>
                    $writer->startelement('paymentSchedule');
                        // <interval>
                        $writer->startelement('interval');
                            $writer->writeElement('length', $this->getField('intervalLength'));
                            $writer->writeElement('unit', $this->getField('intervalUnit'));
                        $writer->endElement();
                        // </interval>
                        $writer->writeElement('startDate', $this->getField('startDate'));
                        $writer->writeElement('totalOccurrences', $this->getField('totalOccurrences'));

                        $trialOccurrences = $this->getField('trialOccurrences');
                        if (! empty($trialOccurrences)) {
                            $writer->writeElement('trialOccurrences', $trialOccurrences);
                        }
                    $writer->endElement();
                    // </paymentSchedule>

                    // <amount>
                    $writer->writeElement('amount', $this->getField('amount'));
                    // </amount>

                    // <trialAmount>
                    $trialAmount = $this->getField('trialAmount');
                    if (! empty($trialAmount)) {
                        $writer->writeElement('trialAmount', $trialAmount);
                    }
                    // </trialAmount>

                    // <payment>
                    $writer->startelement('payment');
                        // <creditCard>
                        $writer->startelement('creditCard');
                            $writer->writeElement('cardNumber', $this->getField('creditCardCardNumber'));
                            $writer->writeElement('expirationDate', $this->getField('creditCardExpirationDate'));
                            $writer->writeElement('cardCode', $this->getField('creditCardCardCode'));
                        $writer->endElement();
                        // </creditCard>

                        // <bankAccount>
                        $bankAccountType = $this->getField('bankAccountType');
                        $bankAccountRoutingNumber = $this->getField('bankAccountRoutingNumber');
                        $bankAccountAccountNumber = $this->getField('bankAccountAccountNumber');
                        $bankAccountNameOnAccount = $this->getField('bankAccountNameOnAccount');
                        $bankAccountEcheckType = $this->getField('bankAccountEcheckType');
                        $bankAccountBankName = $this->getField('bankAccountBankName');

                        if (! empty($bankAccountType) ||
                            ! empty($bankAccountRoutingNumber) ||
                            ! empty($bankAccountAccountNumber) ||
                            ! empty($bankAccountNameOnAccount) ||
                            ! empty($bankAccountEcheckType) ||
                            ! empty($bankAccountBankName)) {
                            $writer->startelement('bankAccount');
                                $writer->writeElement('accountType', $bankAccountType);
                                $writer->writeElement('routingNumber', $bankAccountRoutingNumber);
                                $writer->writeElement('accountNumber', $bankAccountAccountNumber);
                                $writer->writeElement('nameOnAccount', $bankAccountNameOnAccount);
                                $writer->writeElement('echeckType', $bankAccountEcheckType);
                                $writer->writeElement('bankName', $bankAccountBankName);
                            $writer->endElement();
                        }
                        // </bankAccount>

                    $writer->endElement();
                    // </payment>

                    // <order>
                    $invoiceNumber = $this->getField('invoiceNumber');
                    $description = $this->getField('description');

                    if (! empty($invoiceNumber) || ! empty($description)) {
                        $writer->startelement('order');
                            $writer->writeElement('invoiceNumber', $invoiceNumber);
                            $writer->writeElement('description', $description);
                        $writer->endElement();
                    }
                    // </order>

                    // <customer>
                    $customerId = $this->getField('customerId');
                    $customerEmail = $this->getField('customerEmail');
                    $customerPhoneNumber = $this->getField('customerPhoneNumber');
                    $customerFaxNumber = $this->getField('customerFaxNumber');

                    if (! empty($customerId) ||
                        ! empty($customerEmail) ||
                        ! empty($customerPhoneNumber) ||
                        ! empty($customerFaxNumber)) {
                        $writer->startelement('customer');
                            $writer->writeElement('id', $customerId);
                            $writer->writeElement('email', $customerEmail);
                            $writer->writeElement('phoneNumber', $customerPhoneNumber);
                            $writer->writeElement('faxNumber', $customerFaxNumber);
                        $writer->endElement();
                    }
                    // </customer>

                    // <billTo>
                    $billToFirstName = $this->getField('billToFirstName');
                    $billToLastName = $this->getField('billToLastName');
                    $billToCompany = $this->getField('billToCompany');
                    $billToAddress = $this->getField('billToAddress');
                    $billToCity = $this->getField('billToCity');
                    $billToState = $this->getField('billToState');
                    $billToZip = $this->getField('billToZip');
                    $billToCountry = $this->getField('billToCountry');

                    if (! empty($billToFirstName) ||
                            ! empty($billToLastName) ||
                            ! empty($billToCompany) ||
                            ! empty($billToAddress) ||
                            ! empty($billToCity) ||
                            ! empty($billToState) ||
                            ! empty($billToZip) ||
                            ! empty($billToCountry)) {
                        $writer->startelement('billTo');
                            $writer->writeElement('firstName', $billToFirstName);
                            $writer->writeElement('lastName', $billToLastName);
                            $writer->writeElement('company', $billToCompany);
                            $writer->writeElement('address', $billToAddress);
                            $writer->writeElement('city', $billToCity);
                            $writer->writeElement('state', $billToState);
                            $writer->writeElement('zip', $billToZip);
                            $writer->writeElement('country', $billToCountry);
                        $writer->endElement();
                    }
                    // </billTo>

                    // <shipTo>
                    $shipToFirstName = $this->getField('shipToFirstName');
                    $shipToLastName = $this->getField('shipToLastName');
                    $shipToCompany = $this->getField('shipToCompany');
                    $shipToAddress = $this->getField('shipToAddress');
                    $shipToCity = $this->getField('shipToCity');
                    $shipToState = $this->getField('shipToState');
                    $shipToZip = $this->getField('shipToZip');
                    $shipToCountry = $this->getField('shipToCountry');

                    if (! empty($shipToFirstName) ||
                            ! empty($shipToLastName) ||
                            ! empty($shipToCompany) ||
                            ! empty($shipToAddress) ||
                            ! empty($shipToCity) ||
                            ! empty($shipToState) ||
                            ! empty($shipToZip) ||
                            ! empty($shipToCountry)) {
                        $writer->startelement('shipTo');
                            $writer->writeElement('firstName', $shipToFirstName);
                            $writer->writeElement('lastName', $shipToLastName);
                            $writer->writeElement('company', $shipToCompany);
                            $writer->writeElement('address', $shipToAddress);
                            $writer->writeElement('city', $shipToCity);
                            $writer->writeElement('state', $shipToState);
                            $writer->writeElement('zip', $shipToZip);
                            $writer->writeElement('country', $shipToCountry);
                        $writer->endElement();
                    }
                    // </shipTo>

                $writer->endElement();
                // </subscription>

            $writer->endElement();
            // </ARBCreateSubscriptionRequest>

        $writer->endDocument();
        return $writer->outputMemory(true);
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
        $this->post($this->getEndpoint(), $this->getFields(), $this->getHeaders());
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
