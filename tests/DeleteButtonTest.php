<?php

namespace Manojkiran\ActionButtons\Tests;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Manojkiran\ActionButtons\Exceptions\AmbiguousRouteActionFound;
use Manojkiran\ActionButtons\TestCases\Models\Post;
use Manojkiran\ActionButtons\Facades\ActionButton as ActionButtonFacade;

class DeleteButtonTest extends BaseTestCase
{
    public $postObject;

    public $deleteButtonObject;
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
            
    }

     /** @test */
     public function canCreateBasicButtonWithModelAndRoute()
     {
        $basicButtonWithRoute = $this->deleteButtonObject
                            ->setRouteAction('post.destroy',['post' => $this->postObject])
                            ->get();

        $this->assertInstanceOf(HtmlString::class, $basicButtonWithRoute);
     }

     /** @test */
     public function canCreateBasicButtonWithModelAndUrl()
     {
        $basicButtonWithUrl = $this->deleteButtonObject
                            ->setUrlAction('/post/'.$this->postObject)
                            ->get();

        $this->assertInstanceOf(HtmlString::class, $basicButtonWithUrl);
     }

     /** @test */
     public function cannotSetAmbigiousActionsToButton()
     {
        try{
            $this->deleteButtonObject
                            ->setUrlAction('/post/'.$this->postObject)
                            ->setRouteAction('post.destroy',['post' => $this->postObject])
                            ->get();
        }catch(AmbiguousRouteActionFound $e)
        {
            $this->assertEquals(1, $e->getCode());
            $this->assertEquals("Ambiguous action found for Form", $e->getMessage());
            $this->assertEquals("Manojkiran\ActionButtons\Exceptions\AmbiguousRouteActionFound", get_class($e));
        }
    }
}