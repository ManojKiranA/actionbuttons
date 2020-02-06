<?php

namespace Manojkiran\ActionButtons\Buttons;

use Manojkiran\ActionButtons\Contracts\DisablesButtonContract;
use Manojkiran\ActionButtons\Traits\DisablesButton;

class Button implements DisablesButtonContract
{
    use DisablesButton;
}