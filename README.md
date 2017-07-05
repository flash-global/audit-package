# Audit Package

This package provide Audit Client integration for Objective PHP applications.

## Installation

Audit Package needs **PHP 7.0** or up to run correctly.

You will have to integrate it to your Objective PHP project with `composer require fei/audit-package`.

## Integration

As shown below, the Audit Package must be plugged in the application initialization method.

```php
<?php

use ObjectivePHP\Application\AbstractApplication;
use Fei\Service\Audit\Package\AuditPackage;

class Application extends AbstractApplication
{
    public function init()
    {
        // Define some application steps
        $this->addSteps('init', 'bootstrap', 'auth', 'route', 'rendering');
        
        // Initializations...

        // Plugging the Audit Package in the bootstrap step
        $this->getStep('bootstrap')
        ->plug(AuditPackage::class);

        // Other initializations...
    }
}
```
The Audit Package creates an Audit Client service that will be exposed to the application through the ServicesFactory dependency container with "audit.client" as default identifier. Then, you can fetch the audit client as any other service from the factory:

```php

class AnyMiddleware {

    public function __invoke(ApplicationInterface $app) {
        // please note that it's a better practice to inject the audit client 
        // into the middleware rather than pulling it from the container
        $auditClient = $app->getServicesFactory()->get('audit.client');
    }

}

```

### Application configuration

Create a file or edit an existing one in your configuration directory and put your Audit configuration as below:

```php
<?php
use Fei\Service\Audit\Client\Audit;
use Fei\Service\Audit\Package\Config\AuditParam;
return [
    new AuditParam([Audit::OPTION_BASEURL => 'http://audit.dev:8181']),
];
```

In the previous example you need to set this configuration:

* `AuditParam` expects an array, with the allowed following 

    * Audit::OPTION_BASEURL: represent the URL where the API can be contacted in order to send the mails

Please check out `audit-client` documentation for more information about how to use this client.
