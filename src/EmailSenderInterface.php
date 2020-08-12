<?php

namespace perf\Emailing;

use perf\Emailing\Exception\EmailingException;

interface EmailSenderInterface
{
    /**
     * @param EmailInterface $email
     *
     * @return void
     *
     * @throws EmailingException
     */
    public function send(EmailInterface $email): void;
}
