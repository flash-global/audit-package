# Audit Package

This package provide Audit Client integration for Objective PHP applications.

## Installation

Audit Package needs **PHP 7.0** or up to run correctly.

You will have to integrate it to your Objective PHP project with `composer require fei/audit-package`.

## Integration

As shown below, the Audit Package must be plugged in the application initialization method.

The Audit Package create a Audit Client service that will be consumed by the application's middlewares.

```php
<?php

use ObjectivePHP\Application\AbstractApplication;
use Fei\Service\Audit\Package\AuditPackage;

class Application extends AbstractApplication
{
    public function init()
    {
        // Define some application steps
        $this->addSteps('bootstrap', 'init', 'auth', 'route', 'rendering');
        
        // Initializations...

        // Plugging the Audit Package in the bootstrap step
        $this->getStep('bootstrap')
        ->plug(AuditPackage::class);

        // Another initializations...
    }
}
```
### Application configuration

Create a file in your configuration directory and put your Audit configuration as below:

```php
<?php
use Fei\Service\Audit\Client\Audit;
use Fei\Service\Audit\Package\Config\AuditParam;
return [
    new AuditParam([Audit::OPTION_BASEURL => 'http://audit.dev:8181']),
];
```

In the previous example you need to set this configuration:

* `AuditParam` : represent the URL where the API can be contacted in order to send the mails

Please check out `audit-client` documentation for more information about how to use this client.