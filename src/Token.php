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
     * @param string $transactionNumber
     * @param string $paymentMode
     */
    function issue($toWallet, 
                    $token, 
                    $amount, 
                    array $fee, 
                    $transactionNumber = "",
                    $paymentMode = "manual"
    )
    {
        $fee = LedgefarmCore::objToArray($fee);
        if($transactionNumber === "")
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
                "transactionNumber" => $transactionNumber,
                "paymentMode" => $paymentMode
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
}

?>