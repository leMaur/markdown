<?php

declare(strict_types=1);

namespace Lemaur\Markdown\Tests;

use Illuminate\Support\HtmlString;
use Lemaur\Markdown\Markdown;
use Spatie\Snapshots\MatchesSnapshots;

class MarkdownTest extends TestCase
{
    use MatchesSnapshots;

    /** @test */
    public function it_cannot_renders_an_empty_string()
    {
        $markdown = '';

        $html = Markdown::render($markdown);

        $this->assertInstanceOf(HtmlString::class, $html);
        $this->assertTrue($html->isEmpty());
    }

    /** @test */
    public function it_cannot_renders_an_null_string()
    {
        $markdown = null;

        $html = Markdown::render($markdown);

        $this->assertInstanceOf(HtmlString::class, $html);
        $this->assertTrue($html->isEmpty());
    }

    /** @test */
    public function it_can_renders_a_simple_markdown_text()
    {
        $markdown = <<<'MD'
            # Title

            a paragraph with a [link](http://example.com) and a _emphasized text_.
            MD;

        $html = Markdown::render($markdown);

        $this->assertTrue($html->isNotEmpty());
        $this->assertMatchesHtmlSnapshot($html->toHtml());
    }

    /** @test */
    public function it_can_renders_markdown_text_with_custom_blade_component()
    {
        $markdown = <<<'MD'
            <x-html>
                <x-body>
                    # title
                    a paragraph
                </x-body>
            </x-html>
            MD;

        $html = Markdown::render($markdown);

        $this->assertTrue($html->isNotEmpty());
        $this->assertMatchesHtmlSnapshot($html->toHtml());
    }
}
