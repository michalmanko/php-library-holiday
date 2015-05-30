<?php

/*
 * This file is part of the Holiday Library.
 *
 * (c) Michał Mańko <github@michalmanko.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Michalmanko\Holiday\Test\Provider\Exception;

use Michalmanko\Holiday\Provider\Exception\InvalidArgumentException;

/**
 * @author Michał Mańko <github@michalmanko.com>
 */
class InvalidArgumentExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var InvalidArgumentException
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new InvalidArgumentException();
    }

    public function testException()
    {
        $this->assertInstanceOf(
            '\\Michalmanko\\Holiday\\Exception\\InvalidArgumentException',
            $this->object
        );
    }
}
