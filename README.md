# Crowdsdom PHP SDK

[![Build Status](https://travis-ci.org/crowdsdom/php-sdk.svg)](https://travis-ci.org/crowdsdom/php-sdk)
[![Code Climate](https://codeclimate.com/github/crowdsdom/php-sdk/badges/gpa.svg)](https://codeclimate.com/github/crowdsdom/php-sdk)
[![Coverage Status](https://coveralls.io/repos/crowdsdom/php-sdk/badge.svg?branch=master&service=github)](https://coveralls.io/github/crowdsdom/php-sdk?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/crowdsdom/php-sdk.svg?style=flat)](https://packagist.org/packages/crowdsdom/php-sdk)

## Install
```shell
composer require crowdsdom/php-sdk
```

## Example

```php
$apiKey = '';
$apiSecret = '';
$crowdsdom = new Crowdsdom($apiKey, $apiSecret);
$labor = $crowdsdom->labor();

// get all jobs
$jobs = $labor->job()->find();

// get tasks of jobId
$tasks = $labor->job()->tasks($jobId);
 
// approve a task
$labor->task()->approve($taskId);
```