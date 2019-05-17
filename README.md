# sms

Quick sms webservice by [apimaster](http://apimaster.ir/product/sms)

## Installation

Via Composer

``` bash
$ composer require apimaster/sms
```

## Usage

``` php
<?php

include 'vendor/autoload.php';

use APIMaster\SMS\SMS;

SMS::setApiKey('<YOUR_API_KEY');

$sms = SMS::send('0933xxxx957', 106, ['code' => 4859]);

print_r($sms);
```

Replace `<YOUR_API_KEY>` with your given api key.

## Documentation

You can see documents in [postman](https://documenter.getpostman.com/view/3509100/S1LpaX3M). 
Don't forget to check out endpoint examples.

## License

This library is open-sourced package licensed under the MIT license.
