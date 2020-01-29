<?php

declare(strict_types=1);

namespace Ledgefarm\LedgefarmCore;

class BatchTransfer
{
    public $amount;
    public $toWallet;
    public $memo;

    public function __construct($amount = 0, $toWallet = "", $memo = "")
    {
        $this->amount = $amount;
        $this->toWallet = $toWallet;
        $this->memo = $memo;
    }
}

?>