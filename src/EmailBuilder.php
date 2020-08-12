<?php

namespace perf\Emailing;

class EmailBuilder
{
    private const CHARSET_DEFAULT = 'utf-8';

    private bool $html = false;

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

    public function setHtml(bool $html): self
    {
        $this->html = (bool) $html;

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

    public function removeReplyTo(string $emailAddress, ?string $name = null): self
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
            $this->html,
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
