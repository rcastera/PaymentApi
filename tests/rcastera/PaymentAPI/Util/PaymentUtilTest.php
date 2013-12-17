<?php
namespace tests\rcastera\PaymentAPI\Util;

use rcastera\PaymentAPI\Util\PaymentUtil;

class PaymentUtilTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers rcastera\PaymentAPI\Util\PaymentUtil::truncateChars
     */
    public function testTruncateChars()
    {
        $result = PaymentUtil::truncateChars('test', 2);
        $this->assertTrue(strlen($result) == 2);
        $this->assertTrue($result == 'te');
    }

    /**
     * @covers rcastera\PaymentAPI\Util\PaymentUtil::truncateChars
     */
    public function testTruncateCharsStringLessThanLength()
    {
        $result = PaymentUtil::truncateChars('test', 5);
        $this->assertTrue(strlen($result) == 4);
        $this->assertTrue($result == 'test');
    }

    /**
     * @covers rcastera\PaymentAPI\Util\PaymentUtil::cleanCCNumber
     */
    public function testCleanCCNumber()
    {
        $result = PaymentUtil::cleanCCNumber('378-28&*2246310-005#');
        $this->assertTrue($result == '378282246310005');
    }


    /**
     * @covers rcastera\PaymentAPI\Util\PaymentUtil::cleanPhoneNumber
     */
    public function testCleanPhoneNumber()
    {
        $result = PaymentUtil::cleanPhoneNumber('(212)-22*2-34$%+44');
        $this->assertTrue($result == '212-222-3444');
    }

    /**
     * @covers rcastera\PaymentAPI\Util\PaymentUtil::cleanAmt
     */
    public function testCleanAmt()
    {
        $result = PaymentUtil::cleanAmt(45.99, true);
        $this->assertTrue($result == 45);

        $result = PaymentUtil::cleanAmt(45.99);
        $this->assertTrue($result == 45.99);
    }

    /**
     * @covers rcastera\PaymentAPI\Util\PaymentUtil::cleanAmt
     */
    public function testCleanAmtWithDecimal()
    {
        $result = PaymentUtil::cleanAmt(45.99);
        $this->assertTrue($result == 45.99);
    }

    /**
     * @covers rcastera\PaymentAPI\Util\PaymentUtil::cleanAmt
     */
    public function testCleanAmtRemoveIllegalCharacters()
    {
        $result = PaymentUtil::cleanAmt('$4!5.99%#*=');
        $this->assertTrue($result == 45.99);
    }

    /**
     * @covers rcastera\PaymentAPI\Util\PaymentUtil::getIpAddress
     */
    public function testGetIpAddressRemoteAddress()
    {
        $_SERVER['REMOTE_ADDR'] = '192.168.1.1';
        $_SERVER['HTTP_CLIENT_IP'] = null;
        $_SERVER['HTTP_X_FORWARDED_FOR'] = null;
        $result = PaymentUtil::getIpAddress();
        $this->assertTrue($result == '192.168.1.1');
    }

    /**
     * @covers rcastera\PaymentAPI\Util\PaymentUtil::getIpAddress
     */
    public function testGetIpAddressHttpClientId()
    {
        $_SERVER['HTTP_CLIENT_IP'] = '192.168.1.1';
        $_SERVER['HTTP_X_FORWARDED_FOR'] = null;
        $_SERVER['REMOTE_ADDR'] = null;
        $result = PaymentUtil::getIpAddress();
        $this->assertTrue($result == '192.168.1.1');
    }

    /**
     * @covers rcastera\PaymentAPI\Util\PaymentUtil::getIpAddress
     */
    public function testGetIpAddressHttpXForwardFor()
    {
        $_SERVER['REMOTE_ADDR'] = null;
        $_SERVER['HTTP_CLIENT_IP'] = null;
        $_SERVER['HTTP_X_FORWARDED_FOR'] = '192.168.1.1';
        $result = PaymentUtil::getIpAddress();
        $this->assertTrue($result == '192.168.1.1');
    }

    /**
     * @covers rcastera\PaymentAPI\Util\PaymentUtil::isValidCC
     */
    public function testIsValidCC()
    {
        $result = PaymentUtil::isValidCC('378282246310005');
        $this->assertTrue($result);
    }

    /**
     * @covers rcastera\PaymentAPI\Util\PaymentUtil::isValidCC
     */
    public function testIsValidCCNullValue()
    {
        $result = PaymentUtil::isValidCC('');
        $this->assertTrue($result == null);
    }
}
