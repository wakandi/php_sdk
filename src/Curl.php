<?php

namespace Ledgefarm\LedgefarmCore;

/**
 * Class Validation
 *
 * @package Ledgefarm
 */

class Curl
{
    // @const timeout to be used for request
    const TIMEOUT = 30;


    /**
     * Function get to connect with LedgefarmCore server using GET method
     * @param string $url
     * @param array $headers
     * @param array $query
     */
    function get($url = "", $headers = array(), $query = array())
    {
        $ch = curl_init();
        $headers = self::setHeaders($headers);
        $url = $url."?".http_build_query($query);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_SSLCERT, LedgefarmCore::$certFile);
        curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'P12');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSLCERTPASSWD, LedgefarmCore::$certPassword);
        curl_setopt($ch, CURLOPT_TIMEOUT, self::TIMEOUT);
        $resp = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if($err){
            return self::setResponse($err, 2);
        }
        return self::setResponse($resp, 1);
    }

    /**
     * Function get to connect with LedgefarmCore server using POST method
     * @param string $url
     * @param array $headers
     * @param array $body
     */
    function post($url = "", $headers = array(), $body = array())
    {
        $ch = curl_init();
        $headers = self::setHeaders($headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($body));
        curl_setopt($ch, CURLOPT_SSLCERT, LedgefarmCore::$certFile);
        curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'P12');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSLCERTPASSWD, LedgefarmCore::$certPassword);
        curl_setopt($ch, CURLOPT_TIMEOUT, self::TIMEOUT);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $resp = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if($err){
            return self::setResponse($err, 2);
        }
        return self::setResponse($resp, 1);
    }

    /**
     * Function get to connect with LedgefarmCore server using PUT method
     * @param string $url
     * @param array $headers
     * @param array $query
     */
    function put($url = "", $headers = array(), $query = array())
    {
        $ch = curl_init();
        $headers = self::setHeaders($headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($query));
        curl_setopt($ch, CURLOPT_SSLCERT, LedgefarmCore::$certFile);
        curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'P12');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSLCERTPASSWD, LedgefarmCore::$certPassword);
        curl_setopt($ch, CURLOPT_TIMEOUT, self::TIMEOUT);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $resp = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if($err){
            return self::setResponse($err, 2);
        }
        return self::setResponse($resp, 1);
    }

    /**
     * Function setHeaders
     * @param array $header
     * @return array
     */
    function setHeaders($header = array())
    {
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
        );
        if(!empty($header))
        {
            foreach($header as $key=>$value)
            {
                $headers[] = "$key: $value";
            }
        }
        return $headers;
    }

    /**
     * Function setResponse
     * @return array
     */
    function setResponse($response, $type)
    {
        if($type === 1)
        {
            $finalResponse = array(
                "response" => json_decode((string)$response, true)
            );
        }
        else
        {
            $finalResponse = array(
                "response" => array(
                    "success" => false,
                    "error" => array(
                        "message" => $response,
                        "statusCode" => 401
                    )
                )
            );
        }
        return $finalResponse;
    }
}

?>