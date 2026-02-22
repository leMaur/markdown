<?php

declare(strict_types=1);

namespace Lemaur\Markdown\Tests;

use Illuminate\Support\HtmlString;
use Lemaur\Markdown\Markdown;
use Spatie\Snapshots\MatchesSnapshots;

class MarkdownTest extends TestCase
{
    use MatchesSnapshots;

    public function test_cannot_renders_an_empty_string(): void
    {
        $markdown = '';

        $html = Markdown::render($markdown);

        $this->assertInstanceOf(HtmlString::class, $html);
        $this->assertTrue($html->isEmpty());
    }

    public function test_cannot_renders_an_null_input(): void
    {
        $markdown = null;

        $html = Markdown::render($markdown);

        $this->assertInstanceOf(HtmlString::class, $html);
        $this->assertTrue($html->isEmpty());
    }

    public function test_can_renders_a_simple_markdown_text(): void
    {
        $markdown = <<<'MD'
            # Title

            a paragraph with a [link](http://example.com) and a _emphasized text_.
            MD;

        $html = Markdown::render($markdown);

        $this->assertTrue($html->isNotEmpty());
        $this->assertMatchesHtmlSnapshot($html->toHtml());
    }

    public function test_can_renders_markdown_text_with_custom_blade_component(): void
    {
        $markdown = <<<'MD'
            # title
            a paragraph

            <x-alert>error</x-alert>
            MD;

        $html = Markdown::render($markdown);

        $this->assertTrue($html->isNotEmpty());
        $this->assertMatchesHtmlSnapshot($html->toHtml());
    }
}
