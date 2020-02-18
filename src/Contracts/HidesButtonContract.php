<?php

namespace Manojkiran\ActionButtons\Contracts;

interface HidesButtonContract
{
    /**
     * Get check weather the button is Hidden.
     *
     * @return bool
     */
    public function getHidesButton() : bool;

    /**
     * Set check weather the button is Hidden.
     *
     * @param bool $hidesButton Check weather the button is Hidden.
     *
     * @return self
     */
    public function setHidesButton(bool $hidesButton);

    /**
     * Checks for the Condition and hides
     * if the condition is passed.
     *
     * @param bool $hideIf
     *
     * @return $this
     **/
    public function hideIf(bool $hideIf);

    /**
     * Checks for the Condition and hides
     * if the condition is not passed.
     *
     * @param bool $hideUnless
     *
     * @return $this
     **/
    public function hideUnless(bool $hideUnless);
}
