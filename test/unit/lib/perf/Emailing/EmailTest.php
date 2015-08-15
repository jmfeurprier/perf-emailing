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
    public function testGetToWithoutTo()
    {
        $result = $this->email->getTo();

        $this->assertInternalType('array', $result);
        $this->assertCount(0, $result);
    }

    /**
     *
     */
    public function testGetCcWithoutCc()
    {
        $result = $this->email->getCc();

        $this->assertInternalType('array', $result);
        $this->assertCount(0, $result);
    }

    /**
     *
     */
    public function testGetBccWithoutBcc()
    {
        $result = $this->email->getBcc();

        $this->assertInternalType('array', $result);
        $this->assertCount(0, $result);
    }

    /**
     *
     */
    public function testGetSubjectWithoutSubject()
    {
        $result = $this->email->getSubject();

        $this->assertInternalType('string', $result);
        $this->assertSame('', $result);
    }

    /**
     *
     */
    public function testGetMessageWithoutMessage()
    {
        $result = $this->email->getMessage();

        $this->assertInternalType('string', $result);
        $this->assertSame('', $result);
    }
}
