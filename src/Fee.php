<?php

declare(strict_types=1);

namespace Ledgefarm\LedgefarmCore;

class Fee
{
    public $toWallet;
    public $amount;
    public $memo;

    public function __construct($toWallet = "", $amount = 0, $memo = "")
    {
        $this->toWallet = $toWallet;
        $this->amount = $amount;
        $this->memo = $memo;
    }
}

?>