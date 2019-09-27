<?php

namespace Ledgefarm\LedgefarmCore;

/**
 * Class Validation
 *
 * @package Ledgefarm
 */

class Validation
{
    /**
     * Function validateURL
     * @param string $url
     */
    public static function validateURL($url = null)
    {
        if($url && filter_var($url, FILTER_VALIDATE_URL))
        {
            return true;
        }
        return false;
    }

    /**
     * Function validateRequired
     * @param string $field
     */
    public static function validateRequired($field = "")
    {
        if($field === ""){
            return false;
        }
        return true;
    }

    /**
     * Function setValidationMessage
     * @param string $field
     * @param string $fieldType
     */
    public static function setValidationMessage($field, $fieldType)
    {
        if($field === "" || $fieldType === "")
        {
            return false;
        } else {
            switch($fieldType)
            {
                case "INVALID":
                    return $field." is not valid.";
                case "REQUIRED":
                    return $field." is required";
                default:
                    return false;
            }
        }
    }
}

?>