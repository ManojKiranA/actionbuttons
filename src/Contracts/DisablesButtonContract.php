<?php

namespace Manojkiran\ActionButtons\Contracts;

interface DisablesButtonContract
{
    /**
     * Checks for the Condition and disables
     * if the condition is passed.
     *
     * @param bool $disableIf
     *
     * @return $this
     **/
    public function disableIf(bool $disableIf);

    /**
     * Checks for the Condition and disables
     * if the condition is not passed.
     *
     * @param bool $disableUnless
     *
     * @return $this
     **/
    public function disableUnless(bool $disableUnless);

    /**
     * Set check weather the button is Disabled.
     *
     * @param bool $disablesButton Check weather the button is Disabled.
     *
     * @return self
     */
    public function setDisablesButton(bool $disablesButton);

    /**
     * Get check weather the button is Disabled.
     *
     * @return bool
     */
    public function getDisablesButton(): bool;
}