<?php

declare(strict_types=1);

namespace Lemaur\Markdown\Tests;

use Illuminate\Support\Facades\Blade;
use Lemaur\Markdown\MarkdownServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Blade::component('alert', Alert::class);
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('markdown', include __DIR__.'/../config/markdown.php');
    }

    protected function getPackageProviders($app)
    {
        return [
            MarkdownServiceProvider::class,
        ];
    }
}
