<?php
namespace rcastera\PaymentAPI\Util;

class PaymentUtil
{
    /**
     * Truncate characters.
     *
     * @param string $string
     * @param integer $length
     * @return string
     */
    public static function truncateChars($string = '', $length = 0)
    {
        if (strlen(trim($string)) < $length) {
            return $string;
        }

        return substr($string, 0, $length);
    }

    /**
     * Removes all characters from the credit card number except for numbers.
     *
     * @param string $cc
     * @return string
     */
    public static function cleanCCNumber($cc = '')
    {
        $cc = preg_replace('/[^0-9]/', '', trim($cc));
        return (string) $cc;
    }


    /**
     * Removes all characters from the telephone number.
     *
     * @param string $phone
     * @return string
     */
    public static function cleanPhoneNumber($phone = '')
    {
        $phone = preg_replace('/[^0-9\-]/', '', trim($phone));
        return (string) $phone;
    }

    /**
     * Formats monetary amount.
     *
     * @param string/integer/float $amount
     * @param boolean $wholeAmt
     * @return integer/float
     */
    public static function cleanAmt($amount = 0, $wholeAmt = false)
    {
        $amount = preg_replace('/[^0-9.]/', '', trim($amount));
        return ($wholeAmt == true) ? (int) $amount : (float) $amount;
    }

    /**
     * Retrieves the user's ip address.
     *
     * @return boolean/string
     */
    public static function getIpAddress()
    {
        if (isset($_SERVER['HTTP_CLIENT_IP']) && ! empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;
        }
    }

    /**
     * Luhn algorithm.
     *
     * @param string $number
     * @return boolean
     */
    public static function isValidCC($number = '')
    {
        $number = trim($number);

        if (empty($number)) {
            return null;
        }

        $number = (string) $number;
        $checksum = '';

        foreach (str_split(strrev((string) $number)) as $i => $d) {
            $checksum .= $i %2 !== 0 ? $d * 2 : $d;
        }

        return array_sum(str_split($checksum)) % 10 === 0;
    }
}
