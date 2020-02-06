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
     * @return  bool
     */ 
    public function getHidesButton()
    {
        return $this->hidesButton;
    }

    /**
     * Set check weather the button is Hidden.
     *
     * @param  bool  $hidesButton  Check weather the button is Hidden.
     *
     * @return  self
     */ 
    public function setHidesButton(bool $hidesButton)
    {
        $this->hidesButton = $hidesButton;

        return $this;
    }
}