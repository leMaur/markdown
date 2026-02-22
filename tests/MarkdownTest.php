<?php

declare(strict_types=1);

namespace Lemaur\Markdown\Tests;

use Illuminate\Support\HtmlString;
use Lemaur\Markdown\Markdown;
use Spatie\Snapshots\MatchesSnapshots;

class MarkdownTest extends TestCase
{
    use MatchesSnapshots;

    public function testCannotRendersAnEmptyString(): void
    {
        $markdown = '';

        $html = Markdown::render($markdown);

        $this->assertInstanceOf(HtmlString::class, $html);
        $this->assertTrue($html->isEmpty());
    }

    public function testCannotRendersAnNullInput(): void
    {
        $markdown = null;

        $html = Markdown::render($markdown);

        $this->assertInstanceOf(HtmlString::class, $html);
        $this->assertTrue($html->isEmpty());
    }

    public function testCanRendersASimpleMarkdownText(): void
    {
        $markdown = <<<'MD'
            # Title

            a paragraph with a [link](http://example.com) and a _emphasized text_.
            MD;

        $html = Markdown::render($markdown);

        $this->assertTrue($html->isNotEmpty());
        $this->assertMatchesHtmlSnapshot($html->toHtml());
    }

    public function testCanRendersMarkdownTextWithCustomBladeComponent(): void
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
