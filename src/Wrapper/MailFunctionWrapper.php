<?php

namespace perf\Emailing\Wrapper;

class MailFunctionWrapper implements MailFunctionWrapperInterface
{
    public function mail(
        string $to,
        string $subject,
        string $message,
        array|string $additionalHeaders = [],
        string $additionalParameters = ''
    ): bool {
        return mail($to, $subject, $message, $additionalHeaders, $additionalParameters);
    }
}
