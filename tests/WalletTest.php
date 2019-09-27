<?php

use Ledgefarm\LedgefarmCore\Wallet;
use Ledgefarm\LedgefarmCoreTest\BaseLedgefarmCore;

class WalletTest extends PHPUnit_Framework_TestCase {

    public function testCreate() {
        try
        {
            $wallet = new Wallet(BaseLedgefarmCore::TOKEN);
            BaseLedgefarmCore::$walletName = uniqid();
            $resp = $wallet->create(BaseLedgefarmCore::$walletName);
            BaseLedgefarmCore::$walletName = $resp['wallet'];
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

    public function testGetAll() {
        try
        {
            $wallet = new Wallet(BaseLedgefarmCore::TOKEN);
            $wallet->getAll(10, 1);
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

    public function testBlock() {
        try
        {
            $wallet = new Wallet(BaseLedgefarmCore::TOKEN);
            $wallet->block(BaseLedgefarmCore::$walletName);
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            echo $e->getMessage();die;
            $this->assertTrue(false);
        }
    }

    public function testUnblock() {
        try
        {
            $wallet = new Wallet(BaseLedgefarmCore::TOKEN);
            $wallet->unblock(BaseLedgefarmCore::$walletName);
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
            $wallet = new Wallet(BaseLedgefarmCore::TOKEN);
            $wallet->get(BaseLedgefarmCore::$walletName);
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

}

?>