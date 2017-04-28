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
     * @return bool|\Fei\ApiClient\ResponseDescriptor
     */
    public function debug(string $message, int $category = null)
    {
        return $this->notify(
            $this->buildNotification(AuditEvent::LVL_DEBUG, $category)
                ->setMessage($message)
        );
    }

    /**
     * @param string $message
     * @param int|null $category
     * @return bool|\Fei\ApiClient\ResponseDescriptor
     */
    public function info(string $message, int $category = null)
    {
        return $this->notify(
            $this->buildNotification(AuditEvent::LVL_INFO, $category)
                ->setMessage($message)
        );
    }

    /**
     * @param string $message
     * @param int|null $category
     * @return bool|\Fei\ApiClient\ResponseDescriptor
     */
    public function warning(string $message, int $category = null)
    {
        return $this->notify(
            $this->buildNotification(AuditEvent::LVL_WARNING, $category)
                ->setMessage($message)
        );
    }

    /**
     * @param string $message
     * @param int|null $category
     * @return bool|\Fei\ApiClient\ResponseDescriptor
     */
    public function error(string $message, int $category = null)
    {
        return $this->notify(
            $this->buildNotification(AuditEvent::LVL_ERROR, $category)
                ->setMessage($message)
        );
    }

    /**
     * @param string $message
     * @param int|null $category
     * @return bool|\Fei\ApiClient\ResponseDescriptor
     */
    public function panic(string $message, int $category = null)
    {
        return $this->notify(
            $this->buildNotification(AuditEvent::LVL_PANIC, $category)
                ->setMessage($message)
        );
    }

    /**
     * @param $level
     * @param $category
     * @return AuditEvent
     */
    protected function buildNotification($level, $category): AuditEvent
    {
        return new AuditEvent([
            'level' => $level,
            'category' => $category
        ]);
    }
}
