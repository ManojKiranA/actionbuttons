<?php

/*
 * This file is part of the ActionButtons package.
 *
 * (c) Manojkiran Appathurai <manojkiran10031998@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Manojkiran\ActionButtons\Contracts;

use Illuminate\Support\HtmlString;

interface ButtonContract
{
    /**
     * Get name of the Button to be Used for Deletion.
     *
     * @return  string
     */
    public function getButtonName(): string;

    /**
     * Set name of the Button to be Used for Deletion.
     *
     * @param  string  $buttonName  Name of the Button to be Used for Deletion.
     *
     * @return  $this
     */
    public function setButtonName(string $buttonName);

    /**
     * Get route Name which is used for Deletion.
     *
     * @return  array
     */
    public function getRouteAction(): array;

    /**
     * Set route Name which is used for Deletion.
     *
     * @param  string  $routeAction  Route Name which is used for Deletion.
     *
     * @return  self
     */
    public function setRouteAction(...$routeAction);

    /**
     * Get set the Tooltip.
     *
     * @return  string|bool
     */
    public function getToolTip(): string;

    /**
     * Set set the Tooltip.
     *
     * @param  string|bool  $toolTip  Set the Tooltip.
     *
     * @return  $this
     */
    public function setToolTip(string $toolTip);

    /**
     * Get https://getbootstrap.com/docs/4.4/components/tooltips/#options.
     *
     * @return  string|bool
     */
    public function getToolTipPosition(): string;

    /**
     * Set https://getbootstrap.com/docs/4.4/components/tooltips/#options.
     *
     * @param  string|bool  $toolTipPosition  https://getbootstrap.com/docs/4.4/components/tooltips/#options
     *
     * @return  self
     */
    public function setToolTipPosition($toolTipPosition);

    /**
     * Get icon for Delete button.
     *
     * @return  string
     */
    public function getIcon(): string;

    /**
     * Set icon for Delete button.
     *
     * @param  string  $icon  Icon for Delete button.
     *
     * @return  self
     */
    public function setIcon(string $icon);

    /**
     * Get class of the Delete button.
     *
     * @return  string
     */
    public function getClass(): string;

    /**
     * Set class of the Delete button.
     *
     * @param  string  $class  Class of the Delete button.
     *
     * @return  self
     */
    public function setClass(string $class);

    

    /**
     * Get the Html representation of the Button.
     *
     * @return \Illuminate\Support\HtmlString
     **/
    public function get():HtmlString;
}
