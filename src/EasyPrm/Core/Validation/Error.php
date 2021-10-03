<?php

namespace EasyPrm\Core\Validation;

/**
 * Class Error
 */
class Error implements \JsonSerializable
{
    /** @var string|null */
    private $message;
    /** @var string|null */
    private $property;

    /**
     * Error constructor.
     *
     * @param string|null $message
     * @param string|null $property
     */
    public function __construct(?string $message, ?string $property = null)
    {
        $this->message  = $message;
        $this->property = $property;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getProperty(): ?string
    {
        return $this->property;
    }

    public function jsonSerialize(): array
    {
        return [
            'message' => $this->message,
            'property' => $this->property,
        ];
    }

    public function __toString()
    {
        $property = $this->property ?: 'object root';

        return sprintf('Error : %s on %s', $this->message, $property);
    }
}
