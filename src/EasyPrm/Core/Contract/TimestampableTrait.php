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

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
