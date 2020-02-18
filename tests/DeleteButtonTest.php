<?php

namespace Manojkiran\ActionButtons\Tests;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Manojkiran\ActionButtons\Exceptions\AmbiguousRouteActionFound;
use Manojkiran\ActionButtons\Exceptions\ButtonNameAndIconNotSetException;
use Manojkiran\ActionButtons\Facades\ActionButton as ActionButtonFacade;
use Manojkiran\ActionButtons\TestCases\Models\Post;

class DeleteButtonTest extends BaseTestCase
{
    protected $postObject;

    protected $deleteButtonObject;

    protected $deleteButtonObjectWithRoute;

    protected $deleteButtonObjectWithUrl;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->postObject = Post::query()->create([
            'post_name' => Str::random(10),
            'post_content' => Str::random(10),
        ]);

        $this->deleteButtonObject = ActionButtonFacade::delete();
        $this->deleteButtonObjectWithRoute = ActionButtonFacade::delete()->setRouteAction('post.destroy', ['post' => $this->postObject]);
        $this->deleteButtonObjectWithUrl = ActionButtonFacade::delete()->setUrlAction('/post/'.$this->postObject);
    }

    /** @test */
    public function createsBasicButtonWithModelAndRoute()
    {
        $basicButtonWithRoute = $this->deleteButtonObjectWithRoute->get();

        $this->assertInstanceOf(HtmlString::class, $basicButtonWithRoute);
    }

    /** @test */
    public function createsBasicButtonWithModelAndUrl()
    {
        $basicButtonWithUrl = $this->deleteButtonObjectWithUrl->get();

        $this->assertInstanceOf(HtmlString::class, $basicButtonWithUrl);
    }

    /** @test */
    public function settingAmbigiousActionsThrowsException()
    {
        try {
            $this->deleteButtonObject
                            ->setUrlAction('/post/'.$this->postObject)
                            ->setRouteAction('post.destroy', ['post' => $this->postObject])
                            ->get();
        } catch (AmbiguousRouteActionFound $e) {
            $this->assertEquals(1, $e->getCode());
            $this->assertEquals('Ambiguous action found for Form', $e->getMessage());
            $this->assertEquals("Manojkiran\ActionButtons\Exceptions\AmbiguousRouteActionFound", get_class($e));
        }
    }

    /** @test */
    public function unableToUnSetButtonNameAndIcon()
    {
        try {
            $this->deleteButtonObject
                            ->setRouteAction('post.destroy', ['post' => $this->postObject])
                            ->setButtonName(false)
                            ->setIcon(false)
                            ->get();
        } catch (ButtonNameAndIconNotSetException $e) {
            $this->assertEquals(1, $e->getCode());
            $this->assertEquals('Either you need to set text for button or icon for button', $e->getMessage());
            $this->assertEquals("Manojkiran\ActionButtons\Exceptions\ButtonNameAndIconNotSetException", get_class($e));
        }
    }

    /** @test */
    public function getCustomisedToolTipPositionOrText()
    {
        $toolTipPosition = 'Top';

        $toolTipValue = Str::random(10);

        $tooltipName = $this->deleteButtonObjectWithRoute
                            ->setToolTip($toolTipValue)
                            ->setToolTipPosition($toolTipPosition);

        $this->assertEquals($toolTipPosition, $tooltipName->getToolTipPosition());
        $this->assertEquals($toolTipValue, $tooltipName->getToolTip());
    }

    /** @test */
    public function isNotAddedUnnessaryParametersForToolTipIfFalse()
    {
        $toolTipPosition = 'Top';

        $toolTipValue = false;

        $buttonWithToolTip = $this->deleteButtonObjectWithRoute
                            ->setToolTip($toolTipValue)
                            ->setToolTipPosition($toolTipPosition);

        $this->assertEquals($toolTipPosition, $buttonWithToolTip->getToolTipPosition());
        $this->assertEquals($toolTipValue, $buttonWithToolTip->getToolTip());
        $this->assertEquals(2, count($buttonWithToolTip->getButtonOptionParameters()));

        $toolTipKeys = ['data-toggle', 'data-placement', 'title'];

        foreach ($toolTipKeys as  $eachToolTipKeys) {
            $this->assertArrayNotHasKey($eachToolTipKeys, $buttonWithToolTip->getButtonOptionParameters());
        }
    }

    /** @test */
    public function getCustomisedIcon()
    {
        $buttonIcon = Str::random(10);

        $buttonWithToolTip = $this->deleteButtonObjectWithRoute
                            ->setIcon($buttonIcon);

        $this->assertEquals($buttonIcon, $buttonWithToolTip->getIcon());
    }

    /** @test */
    public function getCustomisedButtonName()
    {
        $buttonName = Str::random(10);

        $buttonWithToolTip = $this->deleteButtonObjectWithRoute
                            ->setButtonName($buttonName);

        $this->assertEquals($buttonName, $buttonWithToolTip->getButtonName());
    }

    /** @test */
    public function getCustomisedButtonClassName()
    {
        $buttonClassNames = Str::random(10);

        $buttonWithToolTip = $this->deleteButtonObjectWithRoute
                            ->setClass($buttonClassNames);

        $this->assertEquals($buttonClassNames, $buttonWithToolTip->getClass());
    }

    /** @test */
    public function getCustomisedConfirmationDialog()
    {
        $confirmationDialog = Str::random(10);

        $buttonWithToolTip = $this->deleteButtonObjectWithRoute
                            ->setDeleteConfirmation($confirmationDialog);

        $this->assertEquals($confirmationDialog, $buttonWithToolTip->getDeleteConfirmation());
    }

    /** @test */
    public function disablesConfirmationDialog()
    {
        $confirmationDialog = false;

        $buttonWithToolTip = $this->deleteButtonObjectWithRoute
                            ->setDeleteConfirmation($confirmationDialog);

        $this->assertEquals($confirmationDialog, $buttonWithToolTip->getDeleteConfirmation());
    }

    /** @test */
    public function isNotAddingExtraStylingIfConformationIsDisabled()
    {
        $confirmationDialog = false;

        $buttonWithToolTip = $this->deleteButtonObjectWithRoute
                            ->setDeleteConfirmation($confirmationDialog);

        $confirmButtonKeys = ['style', 'onSubmit'];

        foreach ($confirmButtonKeys as  $eachconfirmButtonKeys) {
            $this->assertArrayNotHasKey($eachconfirmButtonKeys, $buttonWithToolTip->getAtttributesForOpeningForm());
        }
    }

    /** @test */
    public function canCustomiseButtonNameAndIcon()
    {
        $buttonName = Str::random(10);
        $buttonIcon = Str::random(10);

        $buttonWithIconAndText = $this->deleteButtonObjectWithRoute
                                    ->setButtonName($buttonName)
                                    ->setIcon($buttonIcon)
                                    ->getButtonNameWithParameters();

        $this->assertEquals(' <i class="'.$buttonIcon.'"></i>  '.$buttonName.'', $buttonWithIconAndText);
    }

    /** @test */
    public function disablesButtonWhenConditionIsTrue()
    {
        $disableKey = 'disabled';

        $disableIfValue = 'DISABLE';

        $buttonWithDisabledCondition = $this->deleteButtonObjectWithRoute
                            ->disableIf($disableIfValue === "DISABLE");

        $this->assertArrayHasKey($disableKey, $buttonWithDisabledCondition->getButtonOptionParameters());

        $buttonWithNotDisabledCondition = $this->deleteButtonObjectWithRoute
                            ->disableIf($disableIfValue !== "DISABLE");
        
        $this->assertArrayNotHasKey($disableKey, $buttonWithNotDisabledCondition->getButtonOptionParameters());
    }

    /** @test */
    public function disablesButtonWhenConditionIsNotTrue()
    {
        $disableKey = 'disabled';

        $disableIfValue = 'DISABLE';

        $buttonWithDisabledCondition = $this->deleteButtonObjectWithRoute
                            ->disableUnless($disableIfValue === "DISABLE");

        $this->assertArrayNotHasKey($disableKey, $buttonWithDisabledCondition->getButtonOptionParameters());

        $buttonWithNotDisabledCondition = $this->deleteButtonObjectWithRoute
                            ->disableUnless($disableIfValue !== "DISABLE");
        
        $this->assertArrayHasKey($disableKey, $buttonWithNotDisabledCondition->getButtonOptionParameters());
    }

    /** @test */
    public function hidesButtonWhenConditionIsTrue()
    {
        $hideIfValue = 'HIDE';

        $buttonWithHiddenCondition = $this->deleteButtonObjectWithRoute
                            ->hideIf($hideIfValue === "HIDE");

        $this->assertEquals('',$buttonWithHiddenCondition->get()->toHtml());

        $buttonWithNotHiddedCondition = $this->deleteButtonObjectWithRoute
                            ->hideIf($hideIfValue !== "HIDE");
        
        $this->assertNotEquals('',$buttonWithNotHiddedCondition->get()->toHtml());
    }

    /** @test */
    public function hidesButtonWhenConditionIsNotTrue()
    {

        $hideIfValue = 'HIDE';

        $buttonWithHiddenCondition = $this->deleteButtonObjectWithRoute
                            ->hideUnless($hideIfValue === "HIDE");

        $this->assertNotEquals('',$buttonWithHiddenCondition->get()->toHtml());

        $buttonWithNotDisabledCondition = $this->deleteButtonObjectWithRoute
                            ->hideUnless($hideIfValue !== "HIDE");
        
        $this->assertEquals('',$buttonWithNotDisabledCondition->get()->toHtml());
    }


}
