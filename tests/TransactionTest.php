<?php

use Ledgefarm\LedgefarmCore\Transaction;
use Ledgefarm\LedgefarmCoreTest\BaseLedgefarmCore;

class TransactionTest extends PHPUnit_Framework_TestCase {

    public static $transactionId;

    public function testGetAll() {
        try
        {
            $wallet = new Transaction(BaseLedgefarmCore::TOKEN);
            $resp = $wallet->getAll(10, 1);
            self::$transactionId = $resp[0]['transactionId'];
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

    public function testGet() {
        try
        {
            $wallet = new Transaction(BaseLedgefarmCore::TOKEN);
            $wallet->get(self::$transactionId);
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

}

?>