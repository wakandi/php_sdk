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
        curl_setopt($ch, CURLOPT_SSLCERT, LedgefarmCore::$certCrtFile);
        curl_setopt($ch, CURLOPT_SSLKEY, LedgefarmCore::$certKeyFile);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSLCERTPASSWD, LedgefarmCore::$certPassword);
        curl_setopt($ch, CURLOPT_SSLKEYPASSWD, LedgefarmCore::$certPassword);
        curl_setopt($ch, CURLOPT_TIMEOUT, self::TIMEOUT);
        $resp = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return self::setResponse($resp, $httpCode);
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
        curl_setopt($ch, CURLOPT_SSLCERT, LedgefarmCore::$certCrtFile);
        curl_setopt($ch, CURLOPT_SSLKEY, LedgefarmCore::$certKeyFile);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSLCERTPASSWD, LedgefarmCore::$certPassword);
        curl_setopt($ch, CURLOPT_SSLKEYPASSWD, LedgefarmCore::$certPassword);
        curl_setopt($ch, CURLOPT_TIMEOUT, self::TIMEOUT);
        $resp = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return self::setResponse($resp, $httpCode);
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
        curl_setopt($ch, CURLOPT_SSLCERT, LedgefarmCore::$certCrtFile);
        curl_setopt($ch, CURLOPT_SSLKEY, LedgefarmCore::$certKeyFile);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSLCERTPASSWD, LedgefarmCore::$certPassword);
        curl_setopt($ch, CURLOPT_SSLKEYPASSWD, LedgefarmCore::$certPassword);
        curl_setopt($ch, CURLOPT_TIMEOUT, self::TIMEOUT);
        $resp = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return self::setResponse($resp, $httpCode);
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
    function setResponse($response, $httpCode)
    {
        $json = json_decode($response, true);
        $jsonErr = json_last_error();
        if ($jsonErr === 0) {
            if(isset($json['success'])) {
                if($json['success']){
                    $finalResponse = array(
                        "response" => $json
                    );
                } else {
                    $finalResponse = array(
                        "response" => array(
                            "success" => false,
                            "error" => array(
                                "message" => $json['error']['message'],
                                "code" => $httpCode
                            )
                        )
                    );
                }
            } else {
                if(isset($json['results'])){
                    $message = $json['results']['errors'][0]['path'][0]." : ".$json['results']['errors'][0]['message'];
                } else {
                    $message = $json['message'];
                }
                $finalResponse = array(
                    "response" => array(
                        "success" => false,
                        "error" => array(
                            "message" => $message,
                            "code" => $httpCode
                        )
                    )
                );
            }
        } else {
            $message = $response?$response: 'SERVER_ERROR';
            $finalResponse = array(
                "response" => array(
                    "success" => false,
                    "error" => array(
                        "message" => $message,
                        "code" => $httpCode
                    )
                )
            );
        }
        return $finalResponse;
    }
}

?>