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
        $this->email = $email;
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
        $additionalHeaders = [];

        $from = $this->email->getFrom();
        if (null !== $from) {
            $additionalHeaders[] = "From: {$from}";
        }

        $replyTo = $this->email->getReplyTo();
        if (null !== $replyTo) {
            $additionalHeaders[] = "Reply-To: {$replyTo}";
        }

        $cc = $this->email->getCc();
        if (count($cc) > 0) {
            $recipients          = $this->buildRecipientsString($cc);
            $additionalHeaders[] = "Cc: {$recipients}";
        }

        $bcc = $this->email->getBcc();
        if (count($bcc) > 0) {
            $recipients          = $this->buildRecipientsString($bcc);
            $additionalHeaders[] = "Bcc: {$recipients}";
        }

        $additionalHeaders[] = 'MIME-Version: 1.0';

        $contentType = 'text/plain';
        if ($this->email->isHtml()) {
            $contentType = 'text/html';
        }

        $additionalHeaders[] = "Content-Type: {$contentType}; charset=\"{$this->email->getCharset()}\"";

        return join(self::HEADER_END_OF_LINE_STRING, $additionalHeaders);
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
