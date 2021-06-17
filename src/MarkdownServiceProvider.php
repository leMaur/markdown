<?php

namespace Lemaur\Markdown;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Lemaur\Markdown\Commands\MarkdownCommand;

class MarkdownServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('markdown')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_markdown_table')
            ->hasCommand(MarkdownCommand::class);
    }
}
