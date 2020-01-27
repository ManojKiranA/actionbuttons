<?php

namespace Manojkiran\ActionButtons\Tests;

use Manojkiran\ActionButtons\ActionServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class BaseTestCase extends Orchestra
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            ActionServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Form' => "Collective\Html\FormFacade",
            'Html' => "Collective\Html\HtmlFacade",
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application   $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        include_once __DIR__.'/../src/TestCases/Migrations/create_posts_table.php.stub';

        (new \CreatePostTable())->up();
    }
}
