<?php

/*
 * This file is part of the Holiday Library.
 *
 * (c) Michał Mańko <github@michalmanko.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Michalmanko\Holiday\Provider\Exception;

use Michalmanko\Holiday\Exception\InvalidArgumentException as ParentInvalidArgumentException;

/**
 * Exception thrown if an argument does not match with the expected value.
 */
class InvalidArgumentException extends ParentInvalidArgumentException
{
}
