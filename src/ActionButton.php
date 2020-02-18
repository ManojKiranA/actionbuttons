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

use Manojkiran\ActionButtons\Buttons\EditButton;
use Manojkiran\ActionButtons\Buttons\DeleteButton;

class ActionButton
{
    public function delete()
    {
        return new DeleteButton();
    }

    public function edit()
    {
        return new EditButton();
    }
}
