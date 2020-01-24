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

interface Button
{
     /**
     * Get the name of the Button.
     *
     * @return string
     */
    public function getButtonName();

    /**
     * Set the name of the Button.
     *
     * @return string
     */
    public function setButtonName(string $buttonName);

    /**
     * Get the name of Route.
     *
     * @return string
     */
    public function getRouteAction();

    /**
     * Set the name of the Route.
     *
     * @return string
     */
    public function setRouteAction(string $buttonName);

}