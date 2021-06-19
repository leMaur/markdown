<?php

declare(strict_types=1);

namespace Lemaur\Markdown\Tests;

use Lemaur\Markdown\MarkdownServiceProvider;
use Lemaur\Ui\UiServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            MarkdownServiceProvider::class,
            UiServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('markdown', include __DIR__.'/../config/markdown.php');
        $app['config']->set('ui', include __DIR__.'/../vendor/lemaur/ui/config/ui.php');
    }
}
