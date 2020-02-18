<?php

namespace Manojkiran\ActionButtons\Buttons;

use Manojkiran\ActionButtons\Traits\HideButton;
use Manojkiran\ActionButtons\Traits\DisablesButton;
use Manojkiran\ActionButtons\Contracts\HidesButtonContract;
use Manojkiran\ActionButtons\Contracts\DisablesButtonContract;

class Button implements DisablesButtonContract, HidesButtonContract
{
    use DisablesButton;
    use HideButton;
}
