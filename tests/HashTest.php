<?php

namespace Sugarcrm\PasswordHash\Tests;

use Sugarcrm\PasswordHash\Hash;

/**
 *
 * @coversDefaultClass \Sugarcrm\PasswordHash\Hash
 *
 */
class HashTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Hash
     */
    protected $hash;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->hash = new Hash();
    }

    /**
     * @covers ::generateBcrypt
     * @dataProvider providerTestGenerateBcrypt
     */
    public function testGenerateBcrypt($password, $cost)
    {
        $hash = $this->hash->generateBcrypt($password, $cost);
        $this->assertTrue(password_verify(md5($password), $hash));
    }

    public function providerTestGenerateBcrypt()
    {
        return array(
            array('test', 10),
            array('foobar', 4),
            array('wazaaaaa%^$@($*%', 11),
        );
    }

    /**
     * @covers ::generateSha256
     * @covers ::generateSha2
     * @dataProvider providerTestGenerateSha2
     */
    public function testGenerateSha256($password, $rounds)
    {
        $hash = $this->hash->generateSha256($password);
        $this->assertTrue(password_verify(md5($password), $hash));
    }

    /**
     * @covers ::generateSha512
     * @covers ::generateSha2
     * @dataProvider providerTestGenerateSha2
     */
    public function testGenerateSha512($password, $rounds)
    {
        $hash = $this->hash->generateSha512($password);
        $this->assertTrue(password_verify(md5($password), $hash));
    }

    public function providerTestGenerateSha2()
    {
        return array(
            array('test', 5000),
            array('foobar', 1000),
            array('wazaaaaa%^$@($*%', 6000),
        );
    }
}
