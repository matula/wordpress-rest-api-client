# wordpress-rest-api-client

> A Wordpress REST API client for PHP

[![Travis](https://img.shields.io/travis/varsitynewsnetwork/wordpress-rest-api-client.svg?maxAge=2592000?style=flat-square)](https://travis-ci.org/varsitynewsnetwork/wordpress-rest-api-client)

For when you need to make [Wordpress REST API calls](http://v2.wp-api.org/) from
some other PHP project.

## Installation

This library can be installed with [Composer](https://getcomposer.org):

```text
composer require matula/wordpress-rest-api-client
```

The library uses [GuzzleHttp](http://guzzlephp.org)


## Usage

Example:

```php
use Matula\WpApiClient\Auth\WpBasicAuth;
use Matula\WpApiClient\WpClient;

require 'vendor/autoload.php';

$client = new WpClient('http://yourwordpress.com');
$client->setCredentials(new WpBasicAuth('user', 'securepassword'));

$user = $client->users()->get(2);

print_r($user);
```
