<?php

namespace Manojkiran\ActionButtons\Buttons;

use Collective\Html\FormFacade as Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Manojkiran\ActionButtons\Contracts\Button;

class DeleteButton implements Button
{
    /**
     * Name of the Button to be Used for Deletion.
     *
     * @var string
     */
    protected $buttonName = 'Delete';

    /**
     * Class of the Delete button.
     *
     * @var string
     */
    protected $class = 'btn btn-sm btn-outline-danger';

    /**
     * Icon for Delete button.
     *
     * @var string
     */
    protected $icon = 'fas fa-trash';

    /**
     * Set the Confirmation.
     *
     * @var string|bool
     */
    protected $deleteConfirmation = 'Are you Sure';

    /**
     * Set the Tooltip.
     *
     * @var string|bool
     */
    protected $toolTip = 'Delete';

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
     * @var string
     */
    protected $routeAction;

    /**
     * Route Parameter which is used for Deletion.
     *
     * @var array
     */
    protected $routeParameter = [];

    /**
     * Model for Which the Buttons to be Generated.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Create a New Delete Button Instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     **/
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get name of the Button to be Used for Deletion.
     *
     * @return  string
     */
    public function getButtonName(): string
    {
        return $this->buttonName;
    }

    /**
     * Set name of the Button to be Used for Deletion.
     *
     * @param  string  $buttonName  Name of the Button to be Used for Deletion.
     *
     * @return  $this
     */
    public function setButtonName(string $buttonName)
    {
        $this->buttonName = $buttonName;

        return $this;
    }

    /**
     * Get route Name which is used for Deletion.
     *
     * @return  string
     */
    public function getRouteAction(): string
    {
        return $this->routeAction;
    }

    /**
     * Set route Name which is used for Deletion.
     *
     * @param  string  $routeAction  Route Name which is used for Deletion.
     *
     * @return  self
     */
    public function setRouteAction(string $routeAction)
    {
        $this->routeAction = $routeAction;

        return $this;
    }

    /**
     * Get set the Confirmation.
     *
     * @return  string|bool
     */
    public function getDeleteConfirmation(): string
    {
        return $this->deleteConfirmation;
    }

    /**
     * Set set the Confirmation.
     *
     * @param  string|bool  $deleteConfirmation  Set the Confirmation.
     *
     * @return  $this
     */
    public function setDeleteConfirmation($deleteConfirmation)
    {
        $this->deleteConfirmation = $deleteConfirmation;

        return $this;
    }

    /**
     * Get set the Tooltip.
     *
     * @return  string|bool
     */
    public function getToolTip(): string
    {
        return $this->toolTip;
    }

    /**
     * Set set the Tooltip.
     *
     * @param  string|bool  $toolTip  Set the Tooltip.
     *
     * @return  $this
     */
    public function setToolTip(string $toolTip)
    {
        $this->toolTip = $toolTip;

        return $this;
    }

    /**
     * Get https://getbootstrap.com/docs/4.4/components/tooltips/#options.
     *
     * @return  string|bool
     */
    public function getToolTipPosition(): string
    {
        return $this->toolTipPosition;
    }

    /**
     * Set https://getbootstrap.com/docs/4.4/components/tooltips/#options.
     *
     * @param  string|bool  $toolTipPosition  https://getbootstrap.com/docs/4.4/components/tooltips/#options
     *
     * @return  self
     */
    public function setToolTipPosition($toolTipPosition)
    {
        $this->toolTipPosition = $toolTipPosition;

        return $this;
    }

    /**
     * Get icon for Delete button.
     *
     * @return  string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * Set icon for Delete button.
     *
     * @param  string  $icon  Icon for Delete button.
     *
     * @return  self
     */
    public function setIcon(string $icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get class of the Delete button.
     *
     * @return  string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * Set class of the Delete button.
     *
     * @param  string  $class  Class of the Delete button.
     *
     * @return  self
     */
    public function setClass(string $class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get route Parameter which is used for Deletion.
     *
     * @return  array
     */
    public function getRouteParameter(): array
    {
        return $this->routeParameter;
    }

    /**
     * Set route Parameter which is used for Deletion.
     *
     * @param  array  $routeParameter  Route Parameter which is used for Deletion.
     *
     * @return  self
     */
    public function setRouteParameter(array $routeParameter)
    {
        $this->routeParameter = $routeParameter;

        return $this;
    }

    /**
     * Get the Html representation of the Button.
     *
     * @return \Illuminate\Support\HtmlString
     **/
    public function get(): HtmlString
    {
        //@todo Refactor This

        $delteButtonVal = [

            //Route Action to be used for Deletion
            'routeName' => $this->getRouteAction(),

            //Route Action to be used for Deletion
            'routeParameter' => $this->getRouteParameter(),

            //dialog Which needs to be displayes while deleting the record
            'popUpDialog' => $this->getDeleteConfirmation(),

            //Icon for the delete Button
            'buttonIcon' => $this->getIcon(),

            //Text to be Displayed for Delete button
            'buttonName' => $this->getButtonName(),

            //class name for the deletebutton
            'buttonClass' => $this->getClass(),

            //here you can specify the position of tooltip
            'toolTipPosition' => $this->getToolTipPosition(),

            //Tooltip Title used for the Button
            'toolTip' => $this->getToolTip(),
        ];

        $routeParms = $this->getRouteParameter();
        $delteButtonVal = (object) $delteButtonVal;

        $fullRouteAction[] = $delteButtonVal->routeName;

        if ($routeParms && $routeParms !== []):
            foreach ($routeParms as $eachParm => $eachValue):
                $fullRouteAction[$eachParm] = $eachValue;
        endforeach;
        endif;

        $formOpen['route'] = $fullRouteAction;

        if ($this->getDeleteConfirmation()) {
            $formOpen['style'] = 'display:inline';
            $formOpen['onSubmit'] = 'return confirm("'.$delteButtonVal->popUpDialog.'")';
        }

        $formButtonIcon = null;

        if ($delteButtonVal->buttonIcon):
            $formButtonIcon = '<i class="'.$delteButtonVal->buttonIcon.'"></i>';
        endif;

        $formButtonName = null;

        if ($delteButtonVal->buttonName):
            $formButtonName = $delteButtonVal->buttonName;
        endif;

        $buttonToolTip['type'] = 'submit';
        $buttonToolTip['class'] = $delteButtonVal->buttonClass;

        if ($this->getToolTip()):
            $buttonToolTip['data-toggle'] = 'tooltip';
        $buttonToolTip['data-placement'] = $delteButtonVal->toolTipPosition;
        $buttonToolTip['title'] = $delteButtonVal->toolTip;
        endif;

        if ($delteButtonVal->buttonName):
            $formButtonName = $delteButtonVal->buttonName;
        endif;

        $deleteButton = Form::open($formOpen);
        $deleteButton .= method_field('DELETE');
        $deleteButton .= Form::button($formButtonIcon.$formButtonName, $buttonToolTip);
        $deleteButton .= Form::close();

        return new HtmlString($deleteButton);
    }
}
