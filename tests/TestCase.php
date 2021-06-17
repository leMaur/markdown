<?php

declare(strict_types=1);

namespace Lemaur\Markdown\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Lemaur\Markdown\MarkdownServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Lemaur\\Markdown\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            MarkdownServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        include_once __DIR__.'/../database/migrations/create_markdown_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}
