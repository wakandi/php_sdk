<?php

use Ledgefarm\LedgefarmCore\Token;
use Ledgefarm\LedgefarmCore\Fee;
use Ledgefarm\LedgefarmCoreTest\BaseLedgefarmCore;

class TokenTest extends PHPUnit_Framework_TestCase {

    public $feeObj;
    const Token = '<token name>';
    const WALLETNAME = '<another wallet name>';
    const TOKEN = '<wallet access key>';
    const FROMTOKEN = '<another wallet access key>';
    public static $tokenRequestId = '';

    public function __construct()
    {
        BaseLedgefarmCore::setGlobalConfigurations();
        $this->feeObj = new Fee('<fee wallet name>', '<fee amount>', '<fee memo>');
    }

    public function testIssue()
    {
        try
        {
            $token = new Token(BaseLedgefarmCore::TOKEN);
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
            $token = new Token(self::TOKEN);
            $feeArray = array($this->feeObj);
            $token->transfer(self::WALLETNAME, self::Token, '<amount>', $feeArray);
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
            $token = new Token(BaseLedgefarmCore::TOKEN);
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
            $token = new Token(self::TOKEN);
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
            $token = new Token(self::FROMTOKEN);
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
            $token = new Token(self::FROMTOKEN);
            $feeArray = array($this->feeObj);
            $token->reject(self::$tokenRequestId);
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

}

?>