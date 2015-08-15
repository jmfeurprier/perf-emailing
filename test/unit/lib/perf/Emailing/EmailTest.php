<?php

namespace perf\Emailing;

/**
 *
 */
class EmailTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    protected function setUp()
    {
        $this->email = new Email();
    }

    /**
     *
     */
    public function testGetCharsetDefault()
    {
        $result = $this->email->getCharset();

        $this->assertSame('utf-8', $result);
    }

    /**
     *
     */
    public function testGetCharsetModified()
    {
        $charset = 'foo';

        $this->email->setCharset($charset);

        $result = $this->email->getCharset();

        $this->assertSame($charset, $result);
    }

    /**
     *
     */
    public function testGetFromDefault()
    {
        $result = $this->email->getFrom();

        $this->assertNull($result);
    }

    /**
     *
     */
    public function testGetFromModified()
    {
        $from = 'foo@bar.baz';

        $this->email->setFrom($from);

        $result = $this->email->getFrom();

        $this->assertSame($from, $result);
    }

    /**
     *
     */
    public function testGetFromModifiedToNull()
    {
        $this->email->setFrom('foo@bar.baz');
        $this->email->setFrom(null);

        $result = $this->email->getFrom();

        $this->assertNull($result);
    }

    /**
     *
     */
    public function testGetReplyToDefault()
    {
        $result = $this->email->getReplyTo();

        $this->assertNull($result);
    }

    /**
     *
     */
    public function testGetReplyToModified()
    {
        $replyTo = 'foo@bar.baz';

        $this->email->setReplyTo($replyTo);

        $result = $this->email->getReplyTo();

        $this->assertSame($replyTo, $result);
    }

    /**
     *
     */
    public function testGetReplyToModifiedToNull()
    {
        $this->email->setReplyTo('foo@bar.baz');
        $this->email->setReplyTo(null);

        $result = $this->email->getReplyTo();

        $this->assertNull($result);
    }

    /**
     *
     */
    public function testGetToDefault()
    {
        $result = $this->email->getTo();

        $this->assertInternalType('array', $result);
        $this->assertCount(0, $result);
    }

    /**
     *
     */
    public function testGetCcDefault()
    {
        $result = $this->email->getCc();

        $this->assertInternalType('array', $result);
        $this->assertCount(0, $result);
    }

    /**
     *
     */
    public function testGetBccDefault()
    {
        $result = $this->email->getBcc();

        $this->assertInternalType('array', $result);
        $this->assertCount(0, $result);
    }

    /**
     *
     */
    public function testGetSubjectDefault()
    {
        $result = $this->email->getSubject();

        $this->assertInternalType('string', $result);
        $this->assertSame('', $result);
    }

    /**
     *
     */
    public function testGetMessageDefault()
    {
        $result = $this->email->getMessage();

        $this->assertInternalType('string', $result);
        $this->assertSame('', $result);
    }
}
