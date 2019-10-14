<?php

namespace Ledgefarm\LedgefarmCore;

/**
 * Class Settlement
 *
 * @package Ledgefarm
 */

class Settlement {

    /**
     * Construction method to set token
     * @param string $token
     */
    function __construct($token)
    {
        LedgefarmCore::$token = $token;
    }

    /**
     * Get method to retrieve ACH file contained transactions that need to settle
     */
    function get()
    {
        return LedgefarmCore::get(
            array(),
            "/batch",
            true
        );
    }

    /**
     * Put method to update batch status from created to processed
     * @param array $batchIds
     * this is array of array of objects like 
     * array( 
     *  array(
     *      'batchId' => 'xxxxxx', 
     *      'referenceIds' => 'xxxxxxxx'
     *  )
     * )
     */
    function put($batchIds = array())
    {
        return LedgefarmCore::put(
            $batchIds,
            "/batch"
        );
    }

    /**
     * Post method to clear all the batches which have been settled
     * @param array $file
     * This is a file array ($_FILES)
     */
    function post($file = array())
    {
        $extraHeader = array(
            'Content-Type' => 'multipart/form-data'
        );
        return LedgefarmCore::post(
            array(
                'uploadAchFile' => $_FILES['file']['tmp_name'][0]
            ),
            "/batch",
            $extraHeader
        );
    }
}

?>