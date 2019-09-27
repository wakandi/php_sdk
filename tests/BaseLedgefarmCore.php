<?php

namespace Ledgefarm\LedgefarmCoreTest;

use Ledgefarm\LedgefarmCore\LedgefarmCore;

class BaseLedgefarmCore
{
    const TOKEN = '<admin access key>';
    public static $walletName;

    public static function setGlobalConfigurations() {
        LedgefarmCore::setGlobalConfigurations(
            '<api key>',
            '<operator api endpoint>',
            '<p12 certificate file path>',
            '<certificate passphrase>'
        );
    }

}

?>