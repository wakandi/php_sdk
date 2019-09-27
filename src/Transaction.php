<?php

namespace Ledgefarm\LedgefarmCore;

/**
 * Class Transaction
 *
 * @package Ledgefarm
 */

class Transaction
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
     * GetAll method to get list of transactions
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
            "/transaction"
        );
    }

    /**
     * GetAllByToken method to get list of transactions by token
     * @param string $token
     * @param integer $limit
     * @param integer $offset
     */
    function getAllByToken($token = "", $limit = 0, $offset = 0)
    {
        return LedgefarmCore::get(
            array(
                'token' => $token,
                'limit' => $limit,
                'offset' => $offset
            ),
            "/transaction"
        );
    }

    /**
     * GetAllByWallet method to get list of transactions by token
     * @param string $wallet
     * @param integer $limit
     * @param integer $offset
     */
    function getAllByWallet($wallet = "", $limit = 0, $offset = 0)
    {
        return LedgefarmCore::get(
            array(
                'wallet' => $wallet,
                'limit' => $limit,
                'offset' => $offset
            ),
            "/transaction"
        );
    }

    /**
     * Get method to get details of a transaction
     * @param string $id
     */
    function get($id)
    {
        return LedgefarmCore::get(
            array(
                'id' => $id
            ),
            "/transaction"
        );
    }
}

?>