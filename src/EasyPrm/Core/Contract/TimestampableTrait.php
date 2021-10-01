<?php

namespace EasyPrm\Core\Contract;

/**
 * Trait TimestampableTrait
 */
trait TimestampableTrait
{
    /** @var \DateTimeImmutable|null */
    protected $createdAt;
    /** @var \DateTime|null */
    protected $updatedAt;

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }
}
