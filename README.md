## Basic Information
PHP package can be used in operator application to communicate with Wakandi network. This package is available on Packagist server [https://packagist.org/] with the name "ledgefarm/ledgefarmcore". This needs to be included as a reference in your application.

 ### Installation

Create a file named composer.json or if you are going to use this package in existing project then put dependency in your composer.json file.

```json
{
        "require": {
                "ledgefarm/ledgefarmcore": "1.0.0"
        },
        "require-dev": {
            "phpunit/phpunit": "4.0.*"
        }
}
```

and run following command:-

```cli
composer install
```

 ### Configuration

This package uses some configuration to use it. Hence create a base file and in that file make a construct method and set those configurations.
  
```php

use Ledgefarm\LedgefarmCore\LedgefarmCore;

 function __construct()
 {
         LedgefarmCore::setGlobalConfigurations(
            'lf_core_test_6847437634763763476343763376237632276',
            'https://LedgefarmCore.com/api/v2/wallet',
            'op1.crt',
            'op1.key',
            'abcd1234'
        );
 }
```
The settings are used to make the application interact with Ledgefarm core.

-   ApiKey: This is the unique key for each operator that is validating the identity of the operator on each request.

-   LedgefarmApiUrl: It is the hosted URL of the Ledgefarm Core API. This URL should end with a version of the application i.e.  http://host:port/api/[version]/. As of now, the current version is v1.

-  CertCrtPath: This is the path for the certificate crt file. This file is provided at the time when Ledgefarm Core is setup. Ledgefarm API is protected by client certificate authentication. Each operator will get a certificate to interact with Ledgefarm API. This certificate must be provided to interact with Ledgefarm API.

-  CertKeyPath: This is the path for the certificate key file. This file is provided at the time when Ledgefarm Core is setup. Ledgefarm API is protected by client certificate authentication. Each operator will get a certificate to interact with Ledgefarm API. This certificate must be provided to interact with Ledgefarm API.

- CertPassphrase: This is the key to use the certificate file. Client certificate is protected by a passphrase. The passphrase of certificate must be provided to interact with Ledgefarm API.
  

## Services

Services that are available in this package:

-   Wallet Service
-   Transaction Service
-   Token Service

## Usage
### Wallet Service
Wallet service is used to perform all operations related to the wallet like creating wallet, blocking and unblocking a wallet, obtain wallet data etc.
#### Methods:
-   Create : This function is used to create a wallet. You need to pass a username of the wallet (Walletname) that needs to be created. In response, the packageit will return the wallet address and access Key for that wallet. This access Key will be used for further operations using this wallet.
```php

require 'vendor/autoload.php';

use Ledgefarm\LedgefarmCore\Wallet;
use Ledgefarm\LedgefarmCore\Fee;
use Ledgefarm\LedgefarmCore\Token;
use Ledgefarm\LedgefarmCore\Transaction;
use SebastianBergmann\Exporter\Exception;

public $feeObj;

class Operator {
    
    public function __construct()
    {
            $this->feeObj = new Fee('q1w2e37ur4t6', '0.1', 'operator fee');
    }

    public function create()
    {
            try
            {
                $wallet = new Wallet('lf_core_test_445e4s5C453srtrtarg3s9sHsrtr34trqL4yjsWsD34sffarjtT1zdfp7dc');
                $resp = $wallet->create('q1w2e37ur4t5');
                print_r($resp);
            }
            catch(Exception $e)
            {
                echo $e->getMessage(); 
            }
    }
}
```
-   Get: This function is used to obtain the information of a particular wallet by using there walletname. Admin access Key need to be used here for getting the wallet of a user.
```php
public function get()
{
        try
        {
            $wallet = new Wallet('lf_core_test_445e4s5C453srtrtarg3s9sHsrtr34trqL4yjsWsD34sffarjtT1zdfp7dc');
            $resp = $wallet->get('q1w2e37ur4t5');
            print_r($resp);
        }
        catch(Exception $e)
        {
            echo $e->getMessage(); 
        }
}
```
-   GetAll: This function is used to get the list of all the wallets that are registered with the operator. In this limit (pagesize) and offset (starting index position) need to be passed to get the page wise records. Admin access Key need to be used here for getting list of wallets. For example if we have 30 records and page size is 10 then 3 calls need to make with 1,11,21 as offset and 10 as page size in each request.
```php
public function getAll()
{
        try
        {
            $wallet = new Wallet('lf_core_test_445e4s5C453srtrtarg3s9sHsrtr34trqL4yjsWsD34sffarjtT1zdfp7dc');
            $resp = $wallet->getAll(10, 1);
            print_r($resp);
        }
        catch(Exception $e)
        {
            echo $e->getMessage(); 
        }
}
```

-   Block: This function is used to block the user wallet. User wallet address need to pass for blocking a wallet. Admin access Key need to be used here for blocking user wallet.
```php
public function block()
{
        try
        {
            $wallet = new Wallet('lf_core_test_445e4s5C453srtrtarg3s9sHsrtr34trqL4yjsWsD34sffarjtT1zdfp7dc');
            $resp = $wallet->block('q1w2e37ur4t5');
            print_r($resp);
        }
        catch(Exception $e)
        {
            echo $e->getMessage(); 
        }
}
```
-   Unblock: This function is used to unblock the user wallet. User wallet address need to pass for unblocking a wallet. Admin access Key need to be used here for unblocking user wallet.
```php
public function unblock()
{
        try
        {
            $wallet = new Wallet('lf_core_test_445e4s5C453srtrtarg3s9sHsrtr34trqL4yjsWsD34sffarjtT1zdfp7dc');
            $resp = $wallet->unblock('q1w2e37ur4t5');
            print_r($resp);
        }
        catch(Exception $e)
        {
            echo $e->getMessage(); 
        }
}
```
### Token Service
Token service is used to perform all the operations related to tokens. Which includes issue, transfer, withdraw and request token etc.
#### Methods:
-   Issue: This function is used to Issue the token to the user. In this function wallet address of the user to whom token need to be issued, token name, amount and list of all applicable fees need to be passed for the issuing token to the user. Admin access Key need to be used here for issuing token to a user.

```php

public function issue()
{
        try
        {
            $token = new Token('lf_core_test_445e4s5C453srtrtarg3s9sHsrtr34trqL4yjsWsD34sffarjtT1zdfp7dc');
            $feeArray = array($this->feeObj);
            $resp = $token->issue('q1w2e37ur4t5', 'USD', 1, $feeArray);
            print_r($resp);
        }
        catch(Exception $e)
        {
            echo $e->getMessage(); 
        }
}
```

-   Transfer : This function is used to transfer the token from one user to another user. In this function wallet address of the user to whom token need to be transferred, token name, amount and list of all applicable fees need to be passed for the transferring token to the user. Here user�s access Key (sender) need to be passed to transfer token from wallet to wallet.
```php
public function transfer()
{
        try
        {
            $token = new Token('lf_core_test_445e4s5C453srtrtarg3s9sHsrtr34trqL4yjsWsD34sffarjtT1zdfp7dd');
            $feeArray = array($this->feeObj);
            $resp = $token->transfer('q1w2e37ur4t5', 'USD', 1, $feeArray);
            print_r($resp);
        }
        catch(Exception $e)
        {
            echo $e->getMessage(); 
        }
}
```
-   Withdraw: This function is used to withdraw tokens from the user. In this function wallet address of the user from token need to be withdrawn, token name, amount and list of all applicable fees need to be passed for the withdrawing tokens from the user. Admin access Key need to be used to withdrawing tokens from user's wallet.

```php
public function withdraw()
{
        try
        {
            $token = new Token('lf_core_test_445e4s5C453srtrtarg3s9sHsrtr34trqL4yjsWsD34sffarjtT1zdfp7dc');
            $feeArray = array($this->feeObj);
            $resp = $token->withdraw('q1w2e37ur4t5', 'USD', 1, $feeArray);
            print_r($resp);
        }
        catch(Exception $e)
        {
            echo $e->getMessage(); 
        }
}
```

-   Request: This function is used to request tokens from other user. In this function wallet address of the user from token need to be requested, token name and amount need to be passed for the requesting tokens. User�s access Key (request sender) need to be used here for sending requests to other users.

```php
public function request()
{
        try
        {
            $token = new Token('lf_core_test_445e4s5C453srtrtarg3s9sHsrtr34trqL4yjsWsD34sffarjtT1zdfp7dd');
            $resp = $token->request('q1w2e37ur4t5', 'USD', 1);
            print_r($resp);
        }
        catch(Exception $e)
        {
            echo $e->getMessage(); 
        }
}
```

-   Accept: This function is used to accept token request from other user. In this function tokenRequestId and the fee charged by the operator need to pass for the approving token request. User’s access Key (requestee) need to be used here for approving request.

```php
public function accept()
{
        try
        {
            $token = new Token('lf_core_test_445e4s5C453srtrtarg3s9sHsrtr34trqL4yjsWsD34sffarjtT1zdfp7dd');
            $feeArray = array($this->feeObj);
            $resp = $token->accept('lf_core_test_foe14124f6assf7sfas', $feeArray);
            print_r($resp);
        }
        catch(Exception $e)
        {
            echo $e->getMessage(); 
        }
}
```

-   Reject: This function is used to reject token request from other user. In this function tokenRequestId need to pass for the approving token request. User’s access Key (requestee) need to be used here for rejecting request.

```php
public function reject()
{
        try
        {
            $token = new Token('lf_core_test_445e4s5C453srtrtarg3s9sHsrtr34trqL4yjsWsD34sffarjtT1zdfp7dd');
            $feeArray = array($this->feeObj);
            $resp = $token->reject('lf_core_test_foe14124f6assf7sfas');
            print_r($resp);
        }
        catch(Exception $e)
        {
            echo $e->getMessage(); 
        }
}
```


### Transaction Service
Transaction service is used to get the information of a specific transaction or list of transactions.
#### Methods:
-   GetAll: This function is used to get the list of all transactions of the operator . In this limit (pagesize) and offset (starting index position) need to be passed  to get the page wise records. Admin access Key need to be used here for getting list of transactions. For example if we have 30 records and page size is 10 then 3 calls need to make with 1,11,21 as offset and 10 as page size in each request.

```php
public function getAll()
{
        try
        {
            $transaction = new Transaction('lf_core_test_445e4s5C453srtrtarg3s9sHsrtr34trqL4yjsWsD34sffarjtT1zdfp7dc');
            $resp = $transaction->getAll(10, 1);
            print_r($resp);
        }
        catch(Exception $e)
        {
            echo $e->getMessage(); 
        }
}
```

-   Get: This function is used to get the transaction of the operator . Admin access Key need to be used here for getting transaction. We need pass transaction id to get transaction details.

```php
public function get()
{
        try
        {
            $transaction = new Transaction('lf_core_test_445e4s5C453srtrtarg3s9sHsrtr34trqL4yjsWsD34sffarjtT1zdfp7dc');
            $resp = $transaction->get('ehruew3235dsfsh332');
            print_r($resp);
        }
        catch(Exception $e)
        {
            echo $e->getMessage(); 
        }
}
```

-  GetAllByToken: This function is used to get the list of all transactions of the operator by token . In this limit (pagesize) and offset (starting index position) need to be passed to get the page wise records. Admin access key need to be used here for getting list of transactions. For example if we have 30 records and page size is 10 then 3 calls need to make with 1,11,21 as offset and 10 as page size in each request.

```php
public function getAllByToken()
{
        try
        {
            $transaction = new Transaction('xxxxxxxxxxxxxxxxxxxxxx');
            $limit = 10;
            $offset = 1;
            $resp = $transaction->getAllByToken('USD', $limit, $offset);
            print_r($resp);
        }
        catch(Exception $e)
        {
            echo $e->getMessage(); 
        }
}
```

-   GetAllByWallet: This function is used to get the list of all transactions of the operatorby wallet . In this limit (pagesize) and offset (starting index position) need to be passed  to get the page wise records. Admin access key need to be used here for getting list of transactions. For example if we have 30 records and page size is 10 then 3 calls need to make with 1,11,21 as offset and 10 as page size in each request.

```php
public function getAllByWallet()
{
        try
        {
            $transaction = new Transaction('xxxxxxxxxxxxxxxxxxxxxx');
            $limit = 10;
            $offset = 1;
            $resp = $transaction->getAllByWallet('abc@wallxxxx', $limit, $offset);
            print_r($resp);
        }
        catch(Exception $e)
        {
            echo $e->getMessage(); 
        }
}
```