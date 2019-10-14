<?php

namespace Ledgefarm\LedgefarmCore;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

class HttpRequest
{
    public $client;

    function __construct()
    {
        $this->client = new Client(
            array(
                'verify' => false,
                'synchronous' => true
            )
        );
    }

    function get($url = "", $headers = array(), $query = array(), $isBinary = false)
    {
        $options = array(
            'headers' => $headers,
            'cert' => array(
                LedgefarmCore::$certCrtFile,
                LedgefarmCore::$certPassword
            ),
            'ssl_key' => array(
                LedgefarmCore::$certKeyFile,
                LedgefarmCore::$certPassword
            )
        );
        if(!empty($query))
        {
            $options['query'] = $query;
        }
        try
        {
            $response = $this->client->request('GET', $url, $options);
            $body = $response->getBody();
            $code = $response->getStatusCode();
            return $this->setResponse($body, $code);
        }
        catch(BadResponseException $e)
        {
            return $this->setResponse($e->getResponse()->getBody(), $e->getCode());
        }
    }

    function save($url = "", $headers = array(), $body = array(), $method = "POST")
    {
        $options = array(
            'headers' => $headers,
            'cert' => array(
                LedgefarmCore::$certCrtFile,
                LedgefarmCore::$certPassword
            ),
            'ssl_key' => array(
                LedgefarmCore::$certKeyFile,
                LedgefarmCore::$certPassword
            )
        );
        if(!empty($body))
        {
            $options['json'] = $body;
        }
        try
        {
            $response = $this->client->request($method, $url, $options);
            $body = $response->getBody();
            $code = $response->getStatusCode();
            return $this->setResponse($body, $code);
        }
        catch(BadResponseException $e)
        {
            return $this->setResponse($e->getResponse()->getBody(), $e->getCode());
        }
    }

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
                    $message = $json['results']['errors'][0]['message'];
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