<?php

use Ledgefarm\LedgefarmCore\Operator;
use Ledgefarm\LedgefarmCoreTest\BaseLedgefarmCore;

class OperatorTest extends PHPUnit_Framework_TestCase {

    public function __construct()
    {
        BaseLedgefarmCore::setGlobalConfigurations();
    }

    public function testGet()
    {
        try
        {
            $operator = new Operator(BaseLedgefarmCore::ACCESSKEY);
            $operator->get();
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

    public function testOwnedToken()
    {
        try
        {
            $operator = new Operator(BaseLedgefarmCore::ACCESSKEY);
            $operator->ownedToken();
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

    public function testIssuedToken()
    {
        try
        {
            $operator = new Operator(BaseLedgefarmCore::ACCESSKEY);
            $operator->issuedToken();
            $this->assertTrue(true);
        }
        catch(Exception $e)
        {
            $this->assertTrue(false);
        }
    }

}

?>