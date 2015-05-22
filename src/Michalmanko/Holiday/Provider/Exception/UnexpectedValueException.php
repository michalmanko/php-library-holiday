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

use Michalmanko\Holiday\Exception\UnexpectedValueException as ParentUnexpectedValueException;

/**
 * Exception thrown if a value does not match with a set of values.
 */
class UnexpectedValueException extends ParentUnexpectedValueException
{
}
