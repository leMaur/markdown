<?php

declare(strict_types=1);

namespace Lemaur\Markdown\Tests;

use Lemaur\Markdown\Markdown;

class CompiledViewLifecycleTest extends TestCase
{
    public function test_it_keeps_the_temporary_view_after_rendering(): void
    {
        // A unique document per run: its compiled view name comes from the content
        // hash, so a fixed document would already be on disk from an earlier run.
        $token = bin2hex(random_bytes(8));

        $markdown = <<<MD
            # Kept on disk

            A paragraph rendered through the Blade pass ({$token}).
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
