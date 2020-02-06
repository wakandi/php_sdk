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
     * OPTIONAL
     * @param string $name
     * @param string $email
     * @param string $countryCode
     * @param string $phone
     * @param string $avatar
     * @param boolean $isPublic
     * OPTIONAL
     */
    function create($walletName = "", $name = null, $email = null, $countryCode = null, $phone = null, $avatar = null, $isPublic = false)
    {
        return LedgefarmCore::post(
            array(
                'walletName' => $walletName,
                'name' => $name,
                'email' => $email,
                'countryCode' => $countryCode,
                'phone' => $phone,
                'avatar' => $avatar,
                'isPublic' => $isPublic,
            ),
            "/wallet"
        );
    }

    /**
     * Create method to update user wallet
     * @param string $wallet
     * OPTIONAL
     * @param string $name
     * @param string $email
     * @param string $countryCode
     * @param string $phone
     * @param string $avatar
     * @param boolean $isPublic
     * @param boolean $blocked
     * OPTIONAL
     */
    function update($wallet = "", $name = null, $email = null, $countryCode = null, $phone = null, $avatar = null, $isPublic = false, $blocked = false)
    {
        return LedgefarmCore::put(
            array(
                'wallet' => $wallet,
                'name' => $name,
                'email' => $email,
                'countryCode' => $countryCode,
                'phone' => $phone,
                'avatar' => $avatar,
                'isPublic' => $isPublic,
                'blocked' => $blocked
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

     /**
     * Search method to search wallets from directory service
     * @param string $search
     * OPTIONAL
     * @param string $countryCode
     * OPTIONAL
     */
    function search($search = "", $countryCode = "")
    {
        if($countryCode === ""){
            return LedgefarmCore::get(
                array(),
                "/wallet/search?search=".$search
            );
        } else {
            return LedgefarmCore::get(
                array(),
                "/wallet/search?search=".$search."&countryCode=".rawurlencode($countryCode)
            );
        }
    }
}

?>