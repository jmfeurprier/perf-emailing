<?php

namespace perf\Emailing;

class Email implements EmailInterface
{
    private string $contentType;

    private string $charset;

    private ?Recipient $from;

    private ?Recipient $replyTo;

    /**
     * @var Recipient[]
     */
    private array $to = [];

    /**
     * @var Recipient[]
     */
    private array $cc = [];

    /**
     * @var Recipient[]
     */
    private array $bcc = [];

    private string $subject = '';

    private string $message = '';

    public static function createBuilder(): EmailBuilder
    {
        return new EmailBuilder();
    }

    /**
     * @param string         $contentType
     * @param string         $charset
     * @param null|Recipient $from
     * @param null|Recipient $replyTo
     * @param Recipient[]    $to
     * @param Recipient[]    $cc
     * @param Recipient[]    $bcc
     * @param string         $subject
     * @param string         $message
     */
    public function __construct(
        string $contentType,
        string $charset,
        ?Recipient $from,
        ?Recipient $replyTo,
        array $to,
        array $cc,
        array $bcc,
        string $subject,
        string $message
    ) {
        $this->contentType = $contentType;
        $this->charset     = $charset;
        $this->from        = $from;
        $this->replyTo     = $replyTo;
        $this->to          = $to;
        $this->cc          = $cc;
        $this->bcc         = $bcc;
        $this->subject     = $subject;
        $this->message     = $message;
    }

    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * Returns which charset should be used for the e-mail.
     *
     * @return string charset to be used.
     */
    public function getCharset()
    {
        return $this->charset;
    }

    public function getFrom(): ?Recipient
    {
        return $this->from;
    }

    public function getReplyTo(): ?Recipient
    {
        return $this->replyTo;
    }

    /**
     * @return Recipient[]
     */
    public function getTo(): array
    {
        return $this->to;
    }

    /**
     * @return Recipient[]
     */
    public function getCc(): array
    {
        return $this->cc;
    }

    /**
     * @return Recipient[]
     */
    public function getBcc(): array
    {
        return $this->bcc;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
