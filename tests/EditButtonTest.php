<?php

namespace Manojkiran\ActionButtons\Tests;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Manojkiran\ActionButtons\Exceptions\AmbiguousRouteActionFound;
use Manojkiran\ActionButtons\Exceptions\ButtonNameAndIconNotSetException;
use Manojkiran\ActionButtons\Facades\ActionButton as ActionButtonFacade;
use Manojkiran\ActionButtons\TestCases\Models\Post;

class EditButtonTest extends BaseTestCase
{
    protected $postObject;

    protected $editButtonObject;

    protected $editButtonObjectWithRoute;

    protected $editButtonObjectWithUrl;

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

        $this->editButtonObject = ActionButtonFacade::edit();
        $this->editButtonObjectWithRoute = ActionButtonFacade::edit()->setRouteAction('post.edit', ['post' => $this->postObject]);
        $this->editButtonObjectWithUrl = (ActionButtonFacade::edit()->setUrlAction('/post/'.$this->postObject->id,'/edit/'));
    }

    /** @test */
    public function basicButtonWithRoute()
    {
        $this->assertInstanceOf(HtmlString::class,$this->editButtonObjectWithRoute->get());
    }

    /** @test */
    public function basicButtonWithUrl()
    {
        $this->assertInstanceOf(HtmlString::class,$this->editButtonObjectWithUrl->get());
    }

    /** @test */
    public function settingAmbigiousActionsThrowsException()
    {
        try {
            $this->editButtonObject
                            ->setUrlAction('/post/'.$this->postObject)
                            ->setRouteAction('post.edit', ['post' => $this->postObject])
                            ->get();
        } catch (AmbiguousRouteActionFound $e) {
            $this->assertEquals(1, $e->getCode());
            $this->assertEquals('Ambiguous action found', $e->getMessage());
            $this->assertEquals("Manojkiran\ActionButtons\Exceptions\AmbiguousRouteActionFound", get_class($e));
        }
    }

    /** @test */
    public function unableToUnSetButtonNameAndIcon()
    {
        try {
            $this->editButtonObject
                            ->setRouteAction('post.edit', ['post' => $this->postObject])
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

        $tooltipName = $this->editButtonObjectWithRoute
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

        $buttonWithToolTip = $this->editButtonObjectWithRoute
                            ->setToolTip($toolTipValue)
                            ->setToolTipPosition($toolTipPosition);

        $this->assertEquals($toolTipPosition, $buttonWithToolTip->getToolTipPosition());
        $this->assertEquals($toolTipValue, $buttonWithToolTip->getToolTip());
        $this->assertEquals(1, count($buttonWithToolTip->getButtonOptionParameters()));

        $toolTipKeys = ['data-toggle', 'data-placement', 'title'];

        foreach ($toolTipKeys as  $eachToolTipKeys) {
            $this->assertArrayNotHasKey($eachToolTipKeys, $buttonWithToolTip->getButtonOptionParameters());
        }
    }

    /** @test */
    public function getCustomisedIcon()
    {
        $buttonIcon = Str::random(10);

        $buttonWithToolTip = $this->editButtonObjectWithRoute
                            ->setIcon($buttonIcon);

        $this->assertEquals($buttonIcon, $buttonWithToolTip->getIcon());
    }

    /** @test */
    public function getCustomisedButtonName()
    {
        $buttonName = Str::random(10);

        $buttonWithToolTip = $this->editButtonObjectWithRoute
                            ->setButtonName($buttonName);

        $this->assertEquals($buttonName, $buttonWithToolTip->getButtonName());
    }

    /** @test */
    public function getCustomisedButtonClassName()
    {
        $buttonClassNames = Str::random(10);

        $buttonWithToolTip = $this->editButtonObjectWithRoute
                            ->setClass($buttonClassNames);

        $this->assertEquals($buttonClassNames, $buttonWithToolTip->getClass());
    }


    /** @test */
    public function canCustomiseButtonNameAndIcon()
    {
        $buttonName = Str::random(10);
        $buttonIcon = Str::random(10);

        $buttonWithIconAndText = $this->editButtonObjectWithRoute
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

        $buttonWithDisabledCondition = $this->editButtonObjectWithRoute
                            ->disableIf($disableIfValue === "DISABLE");

        $this->assertArrayHasKey($disableKey, $buttonWithDisabledCondition->getButtonOptionParameters());

        $buttonWithNotDisabledCondition = $this->editButtonObjectWithRoute
                            ->disableIf($disableIfValue !== "DISABLE");
        
        $this->assertArrayNotHasKey($disableKey, $buttonWithNotDisabledCondition->getButtonOptionParameters());
    }

    /** @test */
    public function disablesButtonWhenConditionIsNotTrue()
    {
        $disableKey = 'disabled';

        $disableIfValue = 'DISABLE';

        $buttonWithDisabledCondition = $this->editButtonObjectWithRoute
                            ->disableUnless($disableIfValue === "DISABLE");

        $this->assertArrayNotHasKey($disableKey, $buttonWithDisabledCondition->getButtonOptionParameters());

        $buttonWithNotDisabledCondition = $this->editButtonObjectWithRoute
                            ->disableUnless($disableIfValue !== "DISABLE");
        
        $this->assertArrayHasKey($disableKey, $buttonWithNotDisabledCondition->getButtonOptionParameters());
    }

    /** @test */
    public function hidesButtonWhenConditionIsTrue()
    {
        $hideIfValue = 'HIDE';

        $buttonWithHiddenCondition = $this->editButtonObjectWithRoute
                            ->hideIf($hideIfValue === "HIDE");

        $this->assertEquals('',$buttonWithHiddenCondition->get()->toHtml());

        $buttonWithNotHiddedCondition = $this->editButtonObjectWithRoute
                            ->hideIf($hideIfValue !== "HIDE");
        
        $this->assertNotEquals('',$buttonWithNotHiddedCondition->get()->toHtml());
    }

    /** @test */
    public function hidesButtonWhenConditionIsNotTrue()
    {

        $hideIfValue = 'HIDE';

        $buttonWithHiddenCondition = $this->editButtonObjectWithRoute
                            ->hideUnless($hideIfValue === "HIDE");

        $this->assertNotEquals('',$buttonWithHiddenCondition->get()->toHtml());

        $buttonWithNotDisabledCondition = $this->editButtonObjectWithRoute
                            ->hideUnless($hideIfValue !== "HIDE");
        
        $this->assertEquals('',$buttonWithNotDisabledCondition->get()->toHtml());
    }
}
