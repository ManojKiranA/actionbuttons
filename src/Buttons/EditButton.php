<?php

namespace Manojkiran\ActionButtons\Buttons;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Collective\Html\HtmlFacade as HtmlBuilder;
use Manojkiran\ActionButtons\Contracts\EditButtonContract;
use Manojkiran\ActionButtons\Exceptions\AmbiguousRouteActionFound;
use Manojkiran\ActionButtons\Exceptions\ButtonNameAndIconNotSetException;

class EditButton extends Button implements EditButtonContract
{
    /**
     * Name of the Button to be Used for Deletion.
     *
     * @var string
     */
    protected $buttonName;

    /**
     * Class of the Delete button.
     *
     * @var string
     */
    protected $class = 'btn btn-sm btn-outline-info';

    /**
     * Icon for Delete button.
     *
     * @var string
     */
    protected $icon = 'fas fa-pen';

    /**
     * Set the Tooltip.
     *
     * @var string|bool
     */
    protected $toolTip = 'Edit';

    /**
     * Set the Tooltip.
     * For setting the Postion see
     * https://getbootstrap.com/docs/4.4/components/tooltips/#options.
     *
     * @var string|bool
     */
    protected $toolTipPosition = 'top';

    /**
     * Route Name which is used for Deletion.
     *
     * @var string|array
     */
    protected $routeAction;

    /**
     * Url which is used for Deletion.
     *
     * @var string
     */
    protected $urlAction;

    /**
     * Get name of the Button to be Used for Deletion.
     *
     * @return string
     */
    public function getButtonName(): string
    {
        return $this->buttonName;
    }

    /**
     * Set name of the Button to be Used for Deletion.
     *
     * @param string $buttonName Name of the Button to be Used for Deletion.
     *
     * @return $this
     */
    public function setButtonName(string $buttonName)
    {
        $this->buttonName = $buttonName;

        return $this;
    }

    /**
     * Get route Name which is used for Deletion.
     *
     * @return array
     */
    public function getRouteAction(): array
    {
        $routeNameWithParameters = new Collection($this->routeAction);

        if ($routeNameWithParameters->isEmpty()) {
            return [];
        }

        $routeName = $routeNameWithParameters->first();

        $routeParms = $routeNameWithParameters->slice(1)->collapse()->all();

        return ['routeName' => $routeName, 'routeParms' => $routeParms];
    }

    /**
     * Set route Name which is used for Deletion.
     *
     * @param string $routeAction Route Name which is used for Deletion.
     *
     * @return self
     */
    public function setRouteAction(...$routeAction)
    {
        $this->routeAction = $routeAction;

        return $this;
    }

    /**
     * Get url which is used for Deletion.
     *
     * @return string
     */
    public function getUrlAction()
    {
        return $this->urlAction;
    }

    /**
     * Set url which is used for Deletion.
     *
     * @param string $urlAction Url which is used for Deletion.
     *
     * @return self
     */
    public function setUrlAction(string $urlAction)
    {
        $this->urlAction = $urlAction;

        return $this;
    }

    /**
     * Get set the Tooltip.
     *
     * @return string|bool
     */
    public function getToolTip(): string
    {
        return $this->toolTip;
    }

    /**
     * Set set the Tooltip.
     *
     * @param string|bool $toolTip Set the Tooltip.
     *
     * @return $this
     */
    public function setToolTip($toolTip)
    {
        $this->toolTip = $toolTip;

        return $this;
    }

    /**
     * Get https://getbootstrap.com/docs/4.4/components/tooltips/#options.
     *
     * @return string|bool
     */
    public function getToolTipPosition(): string
    {
        return $this->toolTipPosition;
    }

    /**
     * Set https://getbootstrap.com/docs/4.4/components/tooltips/#options.
     *
     * @param string|bool $toolTipPosition https://getbootstrap.com/docs/4.4/components/tooltips/#options
     *
     * @return self
     */
    public function setToolTipPosition($toolTipPosition)
    {
        $this->toolTipPosition = $toolTipPosition;

        return $this;
    }

    /**
     * Get icon for Delete button.
     *
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * Set icon for Delete button.
     *
     * @param string $icon Icon for Delete button.
     *
     * @return self
     */
    public function setIcon(string $icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get class of the Delete button.
     *
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * Set class of the Delete button.
     *
     * @param string $class Class of the Delete button.
     *
     * @return self
     */
    public function setClass(string $class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get all the Props to open a form.
     *
     *
     * @return array
     **/
    public function getUrlForGeneratingHref()
    {
        $hrefLink = null;

        if ($this->getRouteAction() && $this->getRouteAction() !== []) {
            $hrefLink = route(Arr::get($this->getRouteAction(), 'routeName'), Arr::get($this->getRouteAction(), 'routeParms', []));
        }

        if ($this->getUrlAction()) {
            throw_if($hrefLink !== null, AmbiguousRouteActionFound::class);
            $hrefLink = $this->getUrlAction();
        }

        return $hrefLink;
    }

    /**
     * Get the Tooltip with options if the
     * tooltip value is set.
     *
     * @return array
     **/
    public function getButtonOptionParameters()
    {
        $buttonOptions['class'] = $this->class;

        if (!is_bool($this->toolTip) && $this->toolTip) {
            $buttonOptions['data-toggle']    = 'tooltip';
            $buttonOptions['data-placement'] = $this->toolTipPosition;
            $buttonOptions['title']          = $this->toolTip;
        }
        if ($this->getDisablesButton()) {
            $buttonOptions['disabled']       = true;
        }

        return $buttonOptions;
    }

    /**
     * Get the Button text with icon if is Set.
     *
     *
     * @return string
     **/
    public function getButtonNameWithParameters()
    {
        $formButtonIcon = $formButtonName = null;

        if ($this->icon) {
            $formButtonIcon = ' <i class="'.$this->icon.'"></i>  ';
        }

        if ($this->buttonName) {
            $formButtonName = $this->buttonName;
        }

        throw_if($formButtonIcon === null && $formButtonName === null, ButtonNameAndIconNotSetException::class);

        return $formButtonIcon.$formButtonName;
    }

    /**
     * Get the Html representation of the Button.
     *
     * @return \Illuminate\Support\HtmlString
     **/
    public function get(): HtmlString
    {
        if ($this->getHidesButton()) {
            return new HtmlString('');
        }

        return  HtmlBuilder::link($this->getUrlForGeneratingHref(), $this->getButtonNameWithParameters(), $this->getButtonOptionParameters(), false, false);
    }
}
