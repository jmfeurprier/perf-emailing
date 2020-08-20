<?php

namespace perf\Emailing;

class Recipient
{
    private string $address;

    private ?string $name;

    public function __construct(string $address, ?string $name = null)
    {
        $this->address = $address;
        $this->name    = $name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function __toString()
    {
        if (null === $this->name) {
            return $this->getAddress();
        }

        return "{$this->name} <{$this->address}>";
    }
}
