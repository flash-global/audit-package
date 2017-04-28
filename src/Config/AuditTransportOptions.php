<?php
namespace Fei\Service\Audit\Package\Config;

use ObjectivePHP\Config\SingleValueDirective;

/**
 * Class AuditTransportOptions
 * @package Fei\Service\Audit\Package
 */
class AuditTransportOptions extends SingleValueDirective
{
    /**
     * AuditTransportOptions constructor.
     * @param array $value
     */
    public function __construct(array $value = [])
    {
        parent::__construct($value);
    }

    /**
     * Set the options for the basic transport
     * @param array $options
     * @return AuditTransportOptions
     */
    public function setOptions(array $options) : AuditTransportOptions
    {
        $this->value = $options;
        return $this;
    }
}
