<?php

namespace Manojkiran\ActionButtons\Buttons;

use Manojkiran\ActionButtons\Traits\DisablesButton;
use Manojkiran\ActionButtons\Contracts\DisablesButtonContract;
use Manojkiran\ActionButtons\Contracts\HidesButtonContract;
use Manojkiran\ActionButtons\Traits\HideButton;

class Button implements DisablesButtonContract,HidesButtonContract
{
    use DisablesButton ,HideButton;
}
