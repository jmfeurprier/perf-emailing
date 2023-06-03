<?php

namespace perf\Emailing\Wrapper;

interface MailFunctionWrapperInterface
{
    public function mail(
        string $to,
        string $subject,
        string $message,
        array|string $additionalHeaders = [],
        string $additionalParameters = ''
    ): bool;
}
