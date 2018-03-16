<?php

namespace Fei\Service\Audit\Package;

use Fei\Service\Audit\Client\Audit as AuditClient;
use Fei\Service\Audit\Entity\AuditEvent;

/**
 * Class Audit
 * @package ObjectivePHP\Package\Audit
 */
class Audit extends AuditClient
{
    /**
     * @param string $message
     * @param int|null $category
     * @param array $context
     * @param string $namespace
     * @return bool|\Fei\ApiClient\ResponseDescriptor
     */
    public function debug(string $message, int $category = null, array $context = [], string $namespace = '')
    {
        return $this->notify($this->buildNotification(AuditEvent::LVL_DEBUG, $category, $namespace, $message, $context));
    }

    /**
     * @param string $message
     * @param int|null $category
     * @param array $context
     * @param string $namespace
     * @return bool|\Fei\ApiClient\ResponseDescriptor
     */
    public function info(string $message, int $category = null, array $context = [], string $namespace = '')
    {
        return $this->notify($this->buildNotification(AuditEvent::LVL_INFO, $category, $namespace, $message, $context));

    }

    /**
     * @param string $message
     * @param int|null $category
     * @param array $context
     * @param string $namespace
     * @return bool|\Fei\ApiClient\ResponseDescriptor
     */
    public function warning(string $message, int $category = null, array $context = [], string $namespace = '')
    {
        return $this->notify($this->buildNotification(AuditEvent::LVL_WARNING, $category, $namespace, $message, $context));

    }

    /**
     * @param string $message
     * @param int|null $category
     * @param array $context
     * @param string $namespace
     * @return bool|\Fei\ApiClient\ResponseDescriptor
     */
    public function error(string $message, int $category = null, array $context = [], string $namespace = '')
    {
        return $this->notify($this->buildNotification(AuditEvent::LVL_ERROR, $category, $namespace, $message, $context));

    }

    /**
     * @param string $message
     * @param int|null $category
     * @param array $context
     * @param string $namespace
     * @return bool|\Fei\ApiClient\ResponseDescriptor
     */
    public function panic(string $message, int $category = null, array $context = [], string $namespace = '')
    {
        return $this->notify($this->buildNotification(AuditEvent::LVL_PANIC, $category, $namespace, $message, $context));

    }

    /**
     * @param int $level
     * @param int $category
     * @param string $namespace
     * @param string $message
     * @param array $context
     * @return AuditEvent
     */
    protected function buildNotification(int $level, int $category, string $namespace, string $message, array $context): AuditEvent
    {
        return (new AuditEvent())
            ->setLevel($level)
            ->setCategory($category)
            ->setNamespace($namespace)
            ->setMessage($message)
            ->setContext($context);
    }
}
