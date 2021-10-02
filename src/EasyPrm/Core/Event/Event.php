<?php

namespace EasyPrm\Core\Event;

use Psr\EventDispatcher\StoppableEventInterface;

/**
 * Class Event
 */
class Event implements StoppableEventInterface
{
    /** @var bool */
    private $propagationStopped = false;

    public function isPropagationStopped(): bool
    {
        return $this->propagationStopped;
    }

    public function stopPropagation(): void
    {
        $this->propagationStopped = true;
    }
}
