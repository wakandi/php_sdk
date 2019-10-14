<?php

namespace Ledgefarm\LedgefarmCore;

/**
 * Class Operator
 *
 * @package Ledgefarm
 */

class Operator {

    /**
     * Construction method to set token
     * @param string $token
     */
    function __construct($token)
    {
        LedgefarmCore::$token = $token;
    }

    /**
     * Get method to fetch the operator balance on global network
     */
    function get()
    {
        return LedgefarmCore::get(
            array(),
            "/global/wallet"
        );
    }

    /**
     * OwnedToken method to get information about how much token need to take from another operator
     */
    function ownedToken()
    {
        return LedgefarmCore::get(
            array(),
            "/global/token/owned"
        );
    }

    /**
     * IssuedToken method to get how many tokens transferred by the operator to the other operator on global network
     */
    function issuedToken()
    {
        return LedgefarmCore::get(
            array(),
            "/global/token/issued"
        );
    }
}

?>