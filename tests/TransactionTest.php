<?php

use Ledgefarm\LedgefarmCore\Transaction;
use Ledgefarm\LedgefarmCoreTest\BaseLedgefarmCore;

class TransactionTest extends PHPUnit_Framework_TestCase {

    public static $transactionId;

    public function testGetAll() {
        try
        {
            $wallet = new Transaction(BaseLedgefarmCore::ACCESSKEY);
            $resp = $wallet->getAll('<limit>', '<offset');
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
            $wallet = new Transaction(BaseLedgefarmCore::ACCESSKEY);
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