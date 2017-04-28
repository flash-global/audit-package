<?php

namespace Fei\Service\Audit\Package\Config;

use ObjectivePHP\Config\SingleValueDirective;
use Pheanstalk\PheanstalkInterface;

/**
 * Class AuditAsyncTransport
 * @package Fei\Service\Audit\Package
 */
class AuditAsyncTransport extends SingleValueDirective
{
    /**
     * AuditAsyncTransport constructor.
     * @param string $host
     * @param int $port
     */
    public function __construct(string $host = '127.0.0.1', int $port = PheanstalkInterface::DEFAULT_PORT)
    {
        parent::__construct([
            'host' => $host,
            'port' => $port
        ]);
    }

    /**
     * Set the host of the async transport
     * @param string $host
     * @return AuditAsyncTransport
     */
    public function setHost(string $host) : AuditAsyncTransport
    {
        $this->value['host'] = $host;
        return $this;
    }

    /**
     * Set the port of the async transport
     * @param integer $port
     * @return AuditAsyncTransport
     */
    public function setPort(int $port) : AuditAsyncTransport
    {
        $this->value['port'] = $port;
        return $this;
    }
}
