<?php

/*
 * This file is part of the ActionButtons package.
 *
 * (c) Manojkiran Appathurai <manojkiran10031998@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Manojkiran\ActionButtons;

use Illuminate\Database\Eloquent\Model;
use Manojkiran\ActionButtons\Buttons\DeleteButton;

class ActionButton
{
    public function delete(Model $model)
    {
        return new DeleteButton($model);
    }
}

