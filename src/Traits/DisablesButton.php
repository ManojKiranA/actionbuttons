<?php

namespace Manojkiran\ActionButtons\Traits;

/**
 * Trait to Set the Property for Disabling the
 * button based on the condition.
 */
trait DisablesButton
{
    /**
     * Check weather the button is Disabled.
     *
     * @var bool
     */
    protected $disablesButton = false;

    /**
     * Checks for the Condition and disables
     * if the condition is passed.
     *
     * @param bool $disableIf
     *
     * @return $this
     **/
    public function disableIf(bool $disableIf)
    {
        if ($disableIf) {
            $this->setDisablesButton(true);

            return $this;
        } else {
            $this->setDisablesButton(false);

            return $this;
        }
    }

    /**
     * Checks for the Condition and disables
     * if the condition is not passed.
     *
     * @param bool $disableUnless
     *
     * @return $this
     **/
    public function disableUnless(bool $disableUnless)
    {
        if (!$disableUnless) {
            $this->setDisablesButton(true);

            return $this;
        } else {
            $this->setDisablesButton(false);

            return $this;
        }
    }

    /**
     * Set check weather the button is Disabled.
     *
     * @param bool $disablesButton Check weather the button is Disabled.
     *
     * @return self
     */
    public function setDisablesButton(bool $disablesButton)
    {
        $this->disablesButton = $disablesButton;

        return $this;
    }

    /**
     * Get check weather the button is Disabled.
     *
     * @return bool
     */
    public function getDisablesButton():bool
    {
        return $this->disablesButton;
    }
}
