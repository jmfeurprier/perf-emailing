<?php

namespace perf\Emailing;

use PHPUnit\Framework\TestCase;

class EmailBuilderTest extends TestCase
{
    private EmailBuilder $emailBuilder;

    protected function setUp(): void
    {
        $this->emailBuilder = new EmailBuilder();
    }

    public function testGetCharsetDefault()
    {
        $email = $this->emailBuilder->build();

        $this->assertSame('utf-8', $email->getCharset());
    }

    public function testGetCharsetModified()
    {
        $charset = 'foo';

        $this->emailBuilder->setCharset($charset);

        $email = $this->emailBuilder->build();

        $this->assertSame($charset, $email->getCharset());
    }

    public function testGetFromDefault()
    {
        $email = $this->emailBuilder->build();

        $this->assertNull($email->getFrom());
    }

    public function testGetFromModified()
    {
        $fromAddress = 'foo@bar.baz';
        $fromName    = 'Qux';

        $this->emailBuilder->setFrom($fromAddress, $fromName);

        $email = $this->emailBuilder->build();

        $this->assertSame($fromAddress, $email->getFrom()->getAddress());
        $this->assertSame($fromName, $email->getFrom()->getName());
    }

    public function testGetFromModifiedToNull()
    {
        $this->emailBuilder->setFrom('foo@bar.baz');
        $this->emailBuilder->setFrom(null);

        $email = $this->emailBuilder->build();

        $this->assertNull($email->getFrom());
    }

    public function testGetReplyToDefault()
    {
        $email = $this->emailBuilder->build();

        $this->assertNull($email->getReplyTo());
    }

    public function testGetReplyToModified()
    {
        $replyToAddress = 'foo@bar.baz';
        $replyToName    = 'Qux';

        $this->emailBuilder->setReplyTo($replyToAddress, $replyToName);

        $email = $this->emailBuilder->build();

        $this->assertSame($replyToAddress, $email->getReplyTo()->getAddress());
        $this->assertSame($replyToName, $email->getReplyTo()->getName());
    }

    public function testGetReplyToModifiedToNull()
    {
        $this->emailBuilder->setReplyTo('foo@bar.baz');
        $this->emailBuilder->setReplyTo(null);

        $email = $this->emailBuilder->build();

        $this->assertNull($email->getReplyTo());
    }

    public function testGetToDefault()
    {
        $email = $this->emailBuilder->build();

        $this->assertEmpty($email->getTo());
    }

    public function testGetCcDefault()
    {
        $email = $this->emailBuilder->build();

        $this->assertEmpty($email->getCc());
    }

    public function testGetBccDefault()
    {
        $email = $this->emailBuilder->build();

        $this->assertEmpty($email->getBcc());
    }

    public function testGetSubjectDefault()
    {
        $email = $this->emailBuilder->build();

        $this->assertSame('', $email->getSubject());
    }

    public function testGetMessageDefault()
    {
        $email = $this->emailBuilder->build();

        $this->assertSame('', $email->getMessage());
    }
}
