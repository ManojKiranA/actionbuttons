<?php

/*
 * This file is part of the ActionButtons package.
 *
 * (c) Manojkiran Appathurai <manojkiran10031998@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Manojkiran\ActionButtons\Exceptions;

use Exception as BaseException;

class AmbiguousRouteActionFound extends BaseException
{
    /**
     * Create new AmbiguousRouteActionFound.
     *
     * @param string        $message
     * @param int           $code
     * @param BaseException $previous
     *
     * @return void
     **/
    public function __construct(string $message = 'Ambiguous action found', int $code = 1, BaseException $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
