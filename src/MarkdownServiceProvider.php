<?php

declare(strict_types=1);

namespace Lemaur\Markdown;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MarkdownServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('markdown')
            ->hasConfigFile();
    }
}
