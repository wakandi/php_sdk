<?php

namespace Ledgefarm\LedgefarmCore;

use SebastianBergmann\Exporter\Exception;

/**
 * Class LedgefarmCore
 *
 * @package Ledgefarm
 */

class LedgefarmCore
{

    // @var string the base url of LedgefarmCore rest APIs
    public static $apiUrl;

    // @var string the access token of admin/user to authenticate request
    public static $token;

    // @var string the LedgfarmCore API key to be used for requests
    public static $apiKey;

    // @var path the LedgefarmCore certifcate real path to be used to authenticate service
    public static $certFile;

    // @var string the LedgefarmCore passphrase of cert file
    public static $certPassword;

    /**
     * Sets the global configurations required to be used for requests.
     *
     * @param string $apiKey
     * @param string $apiUrl
     * @param string $certFile
     * @param string $certPassword
     * @return boolean
     */
    public static function setGlobalConfigurations($apiKey, $apiUrl, $certFile, $certPassword)
    {
        try
        {
            if(!Validation::validateURL($apiUrl))
            {
                return false;
            }
            self::$apiKey = $apiKey;
            self::$apiUrl = $apiUrl;
            self::$certFile = $certFile;
            self::$certPassword = $certPassword;
            return true;
        } catch(Exception $e)
        {
            return false;
        }
        
    }

    /**
     * Function setHeaders to set apikey and token to each request
     * @return array
     */
    public static function setHeaders()
    {
        return $header = array(
            "apiKey" => self::$apiKey,
            "accessKey" => self::$token
        );
    }

    /**
     * Create a HTTP Get request to LedgefarmCore server
     * @param array $dataArray
     * @param string $requestURL
     */
    public static function get($dataArray = array(), $requestURL = "")
    {
        $header = self::setHeaders();
        $curl = new Curl();
        $requestURL = self::$apiUrl.$requestURL;
        $response = $curl->get($requestURL, $header, $dataArray);
        return self::setResponse($response);
    }

    /**
     * Create a HTTP Post request to LedgefarmCore server
     * @param array $dataArray
     * @param string $requestURL
     */
    public static function post($dataArray = array(), $requestURL = "")
    {
        $header = self::setHeaders();
        $curl = new Curl();
        $requestURL = self::$apiUrl.$requestURL;
        $response = $curl->post($requestURL, $header, $dataArray);
        return self::setResponse($response);
    }

    /**
     * Create a HTTP Put request to LedgefarmCore server
     * @param array $dataArray
     * @param string $requestURL
     */
    public static function put($dataArray = array(), $requestURL = "")
    {
        $header = self::setHeaders();
        $curl = new Curl();
        $requestURL = self::$apiUrl.$requestURL;
        $response = $curl->put($requestURL, $header, $dataArray);
        return self::setResponse($response);
    }

    /**
     * Set response of HTTP requests
     * @param array $response
     */
    public static function setResponse($response)
    {
        if($response['response']['success'])
        {
            return $response['response']['data'];
        }
        else
        {
            if($response['response']['error'])
            {
                throw new Exception(
                    $response['response']['error']['message'],
                    $response['response']['error']['statusCode']
                );
            }
            else
            {
                $message = $response['response']['results']['errors'][0]['path'][0]
                            ." : "
                            .$response['response']['results']['errors'][0]['message'];
                throw new Exception(
                    $message,
                    400
                );
            }
        }
    }

    /**
     * ObjToArray Function to be used to convert nested object into array
     */
    public static function objToArray($obj)
    {
        $json = json_encode($obj);
        if($json)
        {
            return json_decode($json, true);
        }
        return false;
    }
}

?>