<?php

class PayPal
{
    function __construct()
    {
    }

    public static function set_express_checkout($price)
    {
        $nvp = array(
            'USER' => $GLOBALS["paypal_user"],
            'PWD' => $GLOBALS["paypal_pwd"],
            'SIGNATURE' => $GLOBALS["paypal_signature"],
            'VERSION' => '98',
            'METHOD' => 'SetExpressCheckout',

            'RETURNURL' => $GLOBALS["paypal_host"]."/checkout-review.php",
            'CANCELURL' => $GLOBALS["paypal_host"]."/checkout.php",

            'PAYMENTREQUEST_0_AMT' => $price,
            'PAYMENTREQUEST_0_CURRENCYCODE' => "AUD",
            
            "L_PAYMENTREQUEST_0_NAME0" => "Order",
            "L_PAYMENTREQUEST_0_AMT0" => $price,
            "L_PAYMENTREQUEST_0_CURRENCYCODE0" => "AUD"
        );

        $request = 'https://api-3t.sandbox.paypal.com/nvp?'.http_build_query($nvp);

        return PayPal::request($request);
    }

    private static function request($request)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $request);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($curl);

        curl_close($curl);

        return PayPal::parseNVP($response);
    }

    /**
     * Parse response from PayPal API.
     */
    private static function parseNVP($nvp)
    {
        $result = array();
        parse_str($nvp, $result);
        return $result;
    }
}

?>