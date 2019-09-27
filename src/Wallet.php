<?php

namespace Ledgefarm\LedgefarmCore;

/**
 * Class Wallet
 *
 * @package Ledgefarm
 */

class Wallet
{
    /**
     * Construction method to set token
     * @param string $token
     */
    function __construct($token)
    {
        LedgefarmCore::$token = $token;
    }

    /**
     * Create method to create user wallet
     * @param string $walletName
     */
    function create($walletName = "")
    {
        return LedgefarmCore::post(
            array(
                "walletName" => $walletName
            ),
            "/wallet"
        );
    }

    /**
     * GetAll method to get list of users
     * @param integer $limit
     * @param integer $offset
     */
    function getAll($limit = 0, $offset = 0)
    {
        return LedgefarmCore::get(
            array(
                'limit' => $limit,
                'offset' => $offset
            ),
            "/wallet"
        );
    }

    /**
     * Block method to block to a user
     * @param string $walletName
     */
    function block($walletName)
    {
        return LedgefarmCore::put(
            array(
                'wallet' => $walletName,
                'blocked' => true
            ),
            "/wallet"
        );
    }

    /**
     * Unblock method to un-block to a user
     * @param string $walletName
     */
    function unblock($walletName)
    {
        return LedgefarmCore::put(
            array(
                'wallet' => $walletName,
                'blocked' => false
            ),
            "/wallet"
        );
    }

    /**
     * Get method to get details of a user
     * @param string $walletName
     */
    function get($walletName)
    {
        return LedgefarmCore::get(
            array(),
            "/wallet/$walletName"
        );
    }
}

?>