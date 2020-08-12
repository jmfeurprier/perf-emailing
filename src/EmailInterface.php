<?php

namespace perf\Emailing;

interface EmailInterface
{
    public function isHtml(): bool;

    /**
     * Returns which charset should be used for the e-mail.
     *
     * @return string charset to be used.
     */
    public function getCharset();

    public function getFrom(): ?Recipient;

    public function getReplyTo(): ?Recipient;

    /**
     * @return Recipient[]
     */
    public function getTo(): array;

    /**
     * @return Recipient[]
     */
    public function getCc(): array;

    /**
     * @return Recipient[]
     */
    public function getBcc(): array;

    public function getSubject(): string;

    public function getMessage(): string;
}
