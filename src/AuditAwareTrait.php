<?php

namespace Fei\Service\Audit\Package;

/**
 * Class AuditAwareTrait
 * @package Fei\Service\Audit\Package
 */
trait AuditAwareTrait
{
    /** @var  Audit */
    protected $audit;

    /**
     * @return Audit
     */
    public function getAudit(): Audit
    {
        return $this->audit;
    }

    /**
     * @param Audit $audit
     * @return AuditAwareTrait
     */
    public function setAudit(Audit $audit)
    {
        $this->audit = $audit;
        return $this;
    }
}
