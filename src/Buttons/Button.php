<?php

namespace Manojkiran\ActionButtons\Buttons;

use Manojkiran\ActionButtons\Traits\DisablesButton;
use Manojkiran\ActionButtons\Contracts\DisablesButtonContract;

class Button implements DisablesButtonContract
{
    use DisablesButton;
}
