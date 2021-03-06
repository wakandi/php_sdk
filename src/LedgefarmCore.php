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

    // @var path the LedgefarmCore certifcate crt file real path to be used to authenticate service
    public static $certCrtFile;

    // @var path the LedgefarmCore certifcate key file real path to be used to authenticate service
    public static $certKeyFile;

    // @var string the LedgefarmCore passphrase of cert file
    public static $certPassword;

    /**
     * Sets the global configurations required to be used for requests.
     *
     * @param string $apiKey
     * @param string $apiUrl
     * @param string $certCrtFile
     * @param string $certKeyFile
     * @param string $certPassword
     * @return boolean
     */
    public static function setGlobalConfigurations($apiKey, $apiUrl, $certCrtFile, $certKeyFile, $certPassword)
    {
        try
        {
            if(!Validation::validateURL($apiUrl))
            {
                return false;
            }
            self::$apiKey = $apiKey;
            self::$apiUrl = $apiUrl;
            self::$certCrtFile = $certCrtFile;
            self::$certKeyFile = $certKeyFile;
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
    public static function setHeaders($extraHeader = array())
    {
        $headers = array(
            "apiKey" => self::$apiKey,
            "accessKey" => self::$token
        );
        if(!empty($extraHeader))
        {
            foreach($extraHeader as $key=>$value)
            {
                $headers[$key] = $value;
            }
        }
        return $headers;
    }

    /**
     * Create a HTTP Get request to LedgefarmCore server
     * @param array $dataArray
     * @param string $requestURL
     */
    public static function get($dataArray = array(), $requestURL = "", $isBinary = false, $extraHeader = array())
    {
        $header = self::setHeaders($extraHeader);
        $httpRequest = new HttpRequest();
        $requestURL = self::$apiUrl.$requestURL;
        $response = $httpRequest->get($requestURL, $header, $dataArray, $isBinary);
        return self::setResponse($response);
    }

    /**
     * Create a HTTP Post request to LedgefarmCore server
     * @param array $dataArray
     * @param string $requestURL
     */

    public static function post($dataArray = array(), $requestURL = "", $extraHeader = array())
    {
        $header = self::setHeaders($extraHeader);
        $httpRequest = new HttpRequest();
        $requestURL = self::$apiUrl.$requestURL;
        $response = $httpRequest->save($requestURL, $header, $dataArray, 'POST');
        return self::setResponse($response);
    }

    /**
     * Create a HTTP Put request to LedgefarmCore server
     * @param array $dataArray
     * @param string $requestURL
     */
    public static function put($dataArray = array(), $requestURL = "", $extraHeader = array())
    {
        $header = self::setHeaders($extraHeader);
        $httpRequest = new HttpRequest();
        $requestURL = self::$apiUrl.$requestURL;
        $response = $httpRequest->save($requestURL, $header, $dataArray, 'PUT');
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
            throw new Exception(
                $response['response']['error']['message'],
                $response['response']['error']['code']
            );
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