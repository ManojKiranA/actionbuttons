<?php


/*
 * This file is part of the ActionButtons package.
 *
 * (c) Manojkiran Appathurai <manojkiran10031998@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Manojkiran\ActionButtons\Facades;

use Illuminate\Support\Facades\Facade;

class ActionButton extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Action';
    }
}

