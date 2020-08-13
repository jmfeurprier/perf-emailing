<?php

namespace perf\Emailing;

class EmailBuilder
{
    private const CHARSET_DEFAULT = 'utf-8';

    private const CONTENT_TYPE_TEXT    = 'text/plain';
    private const CONTENT_TYPE_HTML    = 'text/html';
    private const CONTENT_TYPE_DEFAULT = self::CONTENT_TYPE_TEXT;

    private string $contentType = self::CONTENT_TYPE_DEFAULT;

    private string $charset = self::CHARSET_DEFAULT;

    private ?Recipient $from = null;

    private ?Recipient $replyTo = null;

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

    public function setHtml(): self
    {
        return $this->setContentType(self::CONTENT_TYPE_HTML);
    }

    public function setPlainText(): self
    {
        return $this->setContentType(self::CONTENT_TYPE_TEXT);
    }

    public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;

        return $this;
    }

    public function setCharset(string $charset): self
    {
        $this->charset = (string) $charset;

        return $this;
    }

    public function setFrom(string $emailAddress, ?string $name = null): self
    {
        $this->from = new Recipient($emailAddress, $name);

        return $this;
    }

    public function removeFrom(): self
    {
        $this->from = null;

        return $this;
    }

    public function setReplyTo(?string $emailAddress, ?string $name = null): self
    {
        $this->replyTo = new Recipient($emailAddress, $name);

        return $this;
    }

    public function removeReplyTo(): self
    {
        $this->replyTo = null;

        return $this;
    }

    public function addTo(string $emailAddress, ?string $name = null): self
    {
        $this->to[] = new Recipient($emailAddress, $name);

        return $this;
    }

    public function clearTo(): self
    {
        $this->to = [];

        return $this;
    }

    public function addCc(string $emailAddress, ?string $name = null): self
    {
        $this->cc[] = new Recipient($emailAddress, $name);

        return $this;
    }

    public function clearCc(): self
    {
        $this->cc = [];

        return $this;
    }

    public function addBcc(string $emailAddress, ?string $name = null): self
    {
        $this->bcc[] = new Recipient($emailAddress, $name);

        return $this;
    }

    public function clearBcc(): self
    {
        $this->bcc = [];

        return $this;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function build(): EmailInterface
    {
        return new Email(
            $this->contentType,
            $this->charset,
            $this->from,
            $this->replyTo,
            $this->to,
            $this->cc,
            $this->bcc,
            $this->subject,
            $this->message
        );
    }
}
