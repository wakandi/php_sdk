<?php

use Ledgefarm\LedgefarmCore\Wallet;
use Ledgefarm\LedgefarmCoreTest\BaseLedgefarmCore;

class WalletTest extends PHPUnit_Framework_TestCase {

    public function testCreate() {
        try
        {
            $wallet = new Wallet(BaseLedgefarmCore::ACCESSKEY);
            BaseLedgefarmCore::$walletName = uniqid();
            $resp = $wallet->create(BaseLedgefarmCore::$walletName, '<name>', '<email>', '<countryCode>', '<phone>', '<avatar>', '<isPublic>');
            BaseLedgefarmCore::$walletName = $resp['wallet'];
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

    public function testUpdate() {
        try
        {
            $wallet = new Wallet(BaseLedgefarmCore::ACCESSKEY);
            $wallet->update(BaseLedgefarmCore::$walletName, '<name>', '<email>', '<countryCode>', '<phone>', '<avatar>', '<isPublic>', '<blocked>');
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
            $wallet = new Wallet(BaseLedgefarmCore::ACCESSKEY);
            $wallet->getAll('<limit>', '<offset>');
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
            $wallet = new Wallet(BaseLedgefarmCore::ACCESSKEY);
            $wallet->get(BaseLedgefarmCore::$walletName);
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

    public function testSearch() {
        try
        {
            $wallet = new Wallet(BaseLedgefarmCore::ACCESSKEY);
            $wallet->search('<search string>', '<countryCode>');
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

}

?>