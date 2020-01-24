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

interface DeleteButtonContract extends ButtonContract
{
    /**
     * Get set the Confirmation.
     *
     * @return  string|bool
     */
    public function getDeleteConfirmation(): string;

    /**
     * Set set the Confirmation.
     *
     * @param  string|bool  $deleteConfirmation  Set the Confirmation.
     *
     * @return  $this
     */
    public function setDeleteConfirmation($deleteConfirmation);
}
