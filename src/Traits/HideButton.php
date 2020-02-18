<?php

namespace Manojkiran\ActionButtons\Traits;

/**
 * Trait to Set the Property for Hiding the
 * button based on the condition.
 */
trait HideButton
{
    /**
     * Check weather the button is Hidden.
     *
     * @var bool
     */
    protected $hidesButton = false;

    /**
     * Get check weather the button is Hidden.
     *
     * @return bool
     */
    public function getHidesButton():bool
    {
        return $this->hidesButton;
    }

    /**
     * Set check weather the button is Hidden.
     *
     * @param bool $hidesButton Check weather the button is Hidden.
     *
     * @return self
     */
    public function setHidesButton(bool $hidesButton)
    {
        $this->hidesButton = $hidesButton;

        return $this;
    }

    /**
     * Checks for the Condition and hides
     * if the condition is passed.
     *
     * @param bool $hideIf
     *
     * @return $this
     **/
    public function hideIf(bool $hideIf)
    {
        if ($hideIf) {
            $this->setHidesButton(true);

            return $this;
        } else {
            $this->setHidesButton(false);

            return $this;
        }
    }

    /**
     * Checks for the Condition and hides
     * if the condition is not passed.
     *
     * @param bool $hideUnless
     *
     * @return $this
     **/
    public function hideUnless(bool $hideUnless)
    {
        if (!$hideUnless) {
            $this->setHidesButton(true);

            return $this;
        } else {
            $this->setHidesButton(false);

            return $this;
        }
    }
}
