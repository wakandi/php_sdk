<?php

use Ledgefarm\LedgefarmCore\Token;
use Ledgefarm\LedgefarmCore\Fee;
use Ledgefarm\LedgefarmCore\BatchTransfer;
use Ledgefarm\LedgefarmCoreTest\BaseLedgefarmCore;

class TokenTest extends PHPUnit_Framework_TestCase {

    public $feeObj;
    public $batchTransferObj;
    const Token = '<token name>';
    const WALLETNAME = '<another wallet name>';
    const ACCESSKEY = '<wallet access key>';
    const FROMACCESSKEY = '<another wallet access key>';
    public static $tokenRequestId = '';

    public function __construct()
    {
        $this->feeObj = new Fee('<fee wallet name>', '<fee amount>', '<fee memo>');
        $this->batchTransferObj = new BatchTransfer('<amount>', '<receiver wallet name>', '<memo>');
    }

    public function testIssue()
    {
        try
        {
            $token = new Token(BaseLedgefarmCore::ACCESSKEY);
            $feeArray = array($this->feeObj);
            $token->issue(self::WALLETNAME, self::Token, '<amount>', $feeArray);
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

    public function testTransfer()
    {
        try
        {
            $token = new Token(self::ACCESSKEY);
            $feeArray = array($this->feeObj);
            $token->transfer(self::WALLETNAME, self::Token, '<amount>', $feeArray);
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

    public function testBatchTransfer()
    {
        try
        {
            $token = new Token(self::ACCESSKEY);
            $feeArray = array($this->feeObj);
            $batchTransferArray = array($this->batchTransferObj);
            $token->batchTransfer(self::Token, '<amount>', $memo, $feeArray, $batchTransferArray);
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

    public function testWitdraw()
    {
        try
        {
            $token = new Token(BaseLedgefarmCore::ACCESSKEY);
            $feeArray = array($this->feeObj);
            $token->withdraw(self::WALLETNAME, self::Token, '<amount>', $feeArray);
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

    public function testRequest()
    {
        try
        {
            $token = new Token(self::ACCESSKEY);
            $resp = $token->request(self::WALLETNAME, self::Token, '<amount>');
            self::$tokenRequestId = $resp['tokenRequestId'];
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

    public function testAccept()
    {
        try
        {
            $token = new Token(self::FROMACCESSKEY);
            $feeArray = array($this->feeObj);
            $token->accept(self::$tokenRequestId, $feeArray);
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

    public function testReject()
    {
        try
        {
            $this->testRequest();
            $token = new Token(self::FROMACCESSKEY);
            $feeArray = array($this->feeObj);
            $token->reject(self::$tokenRequestId);
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

    public function testGet()
    {
        try
        {
            $token = new Token(BaseLedgefarmCore::ACCESSKEY);
            $token->get(self::Token);
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

}

?>