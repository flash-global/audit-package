<?php

namespace Fei\Service\Audit\Package;

use Fei\ApiClient\Transport\BasicTransport;
use Fei\ApiClient\Transport\BeanstalkProxyTransport;
use Fei\Service\Audit\Package\Config\AuditAsyncTransport;
use Fei\Service\Audit\Package\Config\AuditParam;
use Fei\Service\Audit\Package\Config\AuditTransportOptions;
use ObjectivePHP\Application\ApplicationInterface;
use Pheanstalk\Pheanstalk;
use Pheanstalk\PheanstalkInterface;

/**
 * Class AuditPackage
 * @package ObjectivePHP\Package\Audit
 */
class AuditPackage
{
    const DEFAULT_IDENTIFIER = 'audit.client';

    /** @var string */
    protected $identifier;

    /**
     * AuditClientPackage constructor.
     * @param string $serviceIdentifier
     */
    public function __construct(string $serviceIdentifier = self::DEFAULT_IDENTIFIER)
    {
        $this->identifier = $serviceIdentifier;
    }

    /**
     * @param ApplicationInterface $app
     * @throws \ObjectivePHP\ServicesFactory\Exception\Exception
     */
    public function __invoke(ApplicationInterface $app)
    {
        $config = $app->getConfig();

        $options = $config->get(AuditTransportOptions::class);
        $options = (is_array($options)) ? $options : [];

        $setters = [
            'setTransport' => [new BasicTransport($options)]
        ];

        // if a config for the async transport is set, we use it
        if ($config->has(AuditAsyncTransport::class)) {
            $asyncConfig = $config->get(AuditAsyncTransport::class);
            if (isset($asyncConfig['host'])) {
                $proxy = new BeanstalkProxyTransport();
                $proxy->setPheanstalk(
                    new Pheanstalk($asyncConfig['host'], $asyncConfig['port'] ?? PheanstalkInterface::DEFAULT_PORT)
                );
                $setters['setAsyncTransport'] = [$proxy];
            }
        }

        $app->getServicesFactory()->registerService(
            [
                'id' => $this->identifier,
                'class' => Audit::class,
                'params' => [
                    $app->getConfig()->get(AuditParam::class),
                ],
                'setters' => $setters
            ]
        );
    }
}
