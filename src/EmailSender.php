<?php

namespace perf\Emailing;

use perf\Emailing\Exception\EmailingException;
use perf\Emailing\Wrapper\MailFunctionWrapper;
use perf\Emailing\Wrapper\MailFunctionWrapperInterface;

class EmailSender implements EmailSenderInterface
{
    private const EMAIL_RECIPIENT_SEPARATOR = ', ';
    private const HEADER_END_OF_LINE_STRING = "\r\n";

    private MailFunctionWrapperInterface $mailFunctionWrapper;

    private EmailInterface $email;

    /**
     * @var string[]
     */
    private array $additionalHeaders = [];

    public function __construct(MailFunctionWrapperInterface $mailFunctionWrapper = null)
    {
        if (null === $mailFunctionWrapper) {
            $mailFunctionWrapper = new MailFunctionWrapper();
        }

        $this->mailFunctionWrapper = $mailFunctionWrapper;
    }

    /**
     * {@inheritDoc}
     */
    public function send(EmailInterface $email): void
    {
        $this->init($email);

        $success = $this->mailFunctionWrapper->mail(
            $this->getTo(),
            $this->getSubject(),
            $this->getMessage(),
            $this->getAdditionalHeaders()
        );

        if (!$success) {
            throw new EmailingException('Failed to send email.');
        }
    }

    private function init(EmailInterface $email): void
    {
        $this->email             = $email;
        $this->additionalHeaders = [];
    }

    private function getTo(): string
    {
        return $this->buildRecipientsString($this->email->getTo());
    }

    private function getSubject(): string
    {
        return $this->email->getSubject();
    }

    private function getMessage(): string
    {
        return $this->email->getMessage();
    }

    private function getAdditionalHeaders(): string
    {
        $this->processFrom();
        $this->processReplyTo();
        $this->processCc();
        $this->processBcc();
        $this->processContentType();

        return join(self::HEADER_END_OF_LINE_STRING, $this->additionalHeaders);
    }

    private function processFrom(): void
    {
        $from = $this->email->getFrom();

        if (null !== $from) {
            $this->additionalHeaders[] = "From: {$from}";
        }
    }

    private function processReplyTo(): void
    {
        $replyTo = $this->email->getReplyTo();

        if (null !== $replyTo) {
            $this->additionalHeaders[] = "Reply-To: {$replyTo}";
        }
    }

    private function processCc(): void
    {
        $cc = $this->email->getCc();

        if (count($cc) > 0) {
            $recipients                = $this->buildRecipientsString($cc);
            $this->additionalHeaders[] = "Cc: {$recipients}";
        }
    }

    private function processBcc(): void
    {
        $bcc = $this->email->getBcc();

        if (count($bcc) > 0) {
            $recipients                = $this->buildRecipientsString($bcc);
            $this->additionalHeaders[] = "Bcc: {$recipients}";
        }
    }

    private function processContentType(): void
    {
        $contentType = $this->email->getContentType();
        $charset     = $this->email->getCharset();

        $this->additionalHeaders[] = 'MIME-Version: 1.0';
        $this->additionalHeaders[] = "Content-Type: {$contentType}; charset=\"{$charset}\"";
    }

    /**
     * @param Recipient[] $recipients
     *
     * @return string
     */
    private function buildRecipientsString(array $recipients): string
    {
        return join(self::EMAIL_RECIPIENT_SEPARATOR, $recipients);
    }
}
