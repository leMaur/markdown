<?php

declare(strict_types=1);

namespace Lemaur\Markdown\Tests;

use Lemaur\Markdown\Markdown;

class CompiledViewLifecycleTest extends TestCase
{
    public function test_it_keeps_the_temporary_view_after_rendering(): void
    {
        $markdown = <<<'MD'
            # Kept on disk

            A paragraph rendered through the Blade pass.
            MD;

        $before = $this->compiledViewCount();

        Markdown::render($markdown);

        $afterFirstRender = $this->compiledViewCount();

        Markdown::render($markdown);

        $afterSecondRender = $this->compiledViewCount();

        $this->assertSame($before + 1, $afterFirstRender, 'The temporary view must survive the render.');
        $this->assertSame($afterFirstRender, $afterSecondRender, 'The same document must reuse its temporary view.');
    }

    private function compiledViewCount(): int
    {
        $directory = $this->app['config']->get('view.compiled');

        return count(glob($directory.'/*.blade.php') ?: []);
    }
}
