<?php

namespace Ledgefarm\LedgefarmCoreTest;

use Ledgefarm\LedgefarmCore\LedgefarmCore;

class BaseLedgefarmCore
{
    const ACCESSKEY = '<admin access key>';
    public static $walletName;

    public static function setGlobalConfigurations() {
        LedgefarmCore::setGlobalConfigurations(
            '<api key>',
            '<operator api endpoint>',
            '<crt file path>',
            '<key file path>',
            '<certificate passphrase>'
        );
    }

}

?>