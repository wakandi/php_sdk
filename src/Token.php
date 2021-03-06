<?php

namespace Ledgefarm\LedgefarmCore;


/**
 * Class Token
 *
 * @package Ledgefarm
 */

class Token
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
     * Issue method to issue token to a user wallet
     * @param string $toWallet
     * @param string $token
     * @param double $amount
     * @param Fee[] $fee
     * @param string $transactionId
     */
    function issue($toWallet, 
                    $token, 
                    $amount, 
                    array $fee,
                    $transactionId = ""
    )
    {
        $fee = LedgefarmCore::objToArray($fee);
        if($transactionId === "")
        {
            $params = array(
                "toWallet" => $toWallet,
                "token" => $token,
                "amount" => $amount,
                "fee" => $fee
            );
        }
        else
        {
            $params = array(
                "toWallet" => $toWallet,
                "token" => $token,
                "amount" => $amount,
                "fee" => $fee,
                "transactionId" => $transactionId
            );
        }
        return LedgefarmCore::post($params,"/token/issue");
    }

    /**
     * Transfer method to transfer token to a user wallet
     * @param string $toWallet
     * @param string $token
     * @param double $amount
     * @param Fee[] $fee
     */
    function transfer($toWallet, $token, $amount, array $fee)
    {
        $fee = LedgefarmCore::objToArray($fee);
        $params = array(
            "toWallet" => $toWallet,
            "token" => $token,
            "amount" => $amount,
            "fee" => $fee
        );
        return LedgefarmCore::post($params,"/token/transfer");
    }

    /**
     * Batch transfer method to transfer token to multiple users wallet
     * @param string $token
     * @param double $amount
     * @param string $memo
     * @param Fee[] $fee
     * @param Batch[] $batch
     */
    function batchTransfer($token, $amount, $memo, array $fee, array $batch)
    {
        $fee = LedgefarmCore::objToArray($fee);
        $batch = LedgefarmCore::objToArray($batch);
        $params = array(
            "token" => $token,
            "amount" => $amount,
            "memo" => $memo,
            "fee" => $fee,
            "batchTransferRequest" => $batch
        );
        return LedgefarmCore::post($params,"/token/transfer/batch");
    }
    
    /**
     * Withdraw method to withdraw token from a user wallet
     * @param string $fromWallet
     * @param string $token
     * @param double $amount
     * @param Fee[] $fee
     */
    function withdraw($fromWallet, $token, $amount, array $fee)
    {
        $fee = LedgefarmCore::objToArray($fee);
        $params = array(
            "fromWallet" => $fromWallet,
            "token" => $token,
            "amount" => $amount,
            "fee" => $fee
        );
        return LedgefarmCore::post($params,"/token/withdraw");
    }

    /**
     * Request method to request token from a user
     * @param string $fromWallet
     * @param string $token
     * @param double $amount
     */
    function request($fromWallet, $token, $amount)
    {
        $params = array(
            "fromWallet" => $fromWallet,
            "token" => $token,
            "amount" => $amount
        );
        return LedgefarmCore::post($params,"/token/request");
    }

    /**
     * Accept method to accept request of a user
     * @param string $tokenRequestId
     * @param Fee[] $fee
     */
    function accept($tokenRequestId, array $fee)
    {
        $fee = LedgefarmCore::objToArray($fee);
        $params = array(
            "tokenRequestId" => $tokenRequestId,
            "fee" => $fee
        );
        return LedgefarmCore::post($params,"/token/request/accept");
    }

    /**
     * Reject method to reject request of a user
     * @param string $tokenRequestId
     */
    function reject($tokenRequestId)
    {
        $params = array(
            "tokenRequestId" => $tokenRequestId
        );
        return LedgefarmCore::post($params,"/token/request/reject");
    }

    /**
     * get method to get total supply of given token
     * @param string $token
     */
    function get($token)
    {
        return LedgefarmCore::get(
            array(),
            "/token/$token"
        );
    }
}

?>