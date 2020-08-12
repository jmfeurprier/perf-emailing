<?php

namespace perf\Emailing\Wrapper;

interface MailFunctionWrapperInterface
{
    public function mail(
        string $to,
        string $subject,
        string $message,
        $additionalHeaders = null,
        $additionalParameters = null
    ): bool;
}
