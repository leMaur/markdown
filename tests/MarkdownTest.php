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

    public function test_it_does_not_run_blade_inside_a_fenced_code_block(): void
    {
        $markdown = <<<'MD'
            # title

            <x-alert>rendered</x-alert>

            ```blade
            <x-alert>literal</x-alert>
            ```
            MD;

        $html = Markdown::render($markdown)->toHtml();

        // The component in prose is rendered...
        $this->assertStringContainsString('alert alert-danger', $html);
        $this->assertStringContainsString('rendered', $html);

        // ...but the one inside the code block is shown as escaped, literal text.
        $this->assertStringContainsString('&lt;x-alert&gt;literal&lt;/x-alert&gt;', $html);

        // Exactly one alert div was rendered (prose), proving the code-block one did NOT execute.
        $this->assertSame(1, substr_count($html, 'alert-danger'));

        // The placeholder must never leak into the output.
        $this->assertStringNotContainsString('[[blade-protect', $html);
    }

    public function test_it_does_not_run_blade_inside_inline_code(): void
    {
        $markdown = <<<'MD'
            a paragraph with `<x-alert>inline</x-alert>` inline code.
            MD;

        $html = Markdown::render($markdown)->toHtml();

        $this->assertStringContainsString('<code>&lt;x-alert&gt;inline&lt;/x-alert&gt;</code>', $html);
        $this->assertStringNotContainsString('alert-danger', $html);
        $this->assertStringNotContainsString('[[blade-protect', $html);
    }

    public function test_it_does_not_evaluate_blade_echoes_inside_a_code_block(): void
    {
        $markdown = <<<'MD'
            ```php
            {{ 40 + 2 }}
            ```
            MD;

        $html = Markdown::render($markdown)->toHtml();

        $this->assertStringContainsString('{{ 40 + 2 }}', $html);
        $this->assertStringNotContainsString('42', $html);
        $this->assertStringNotContainsString('[[blade-protect', $html);
    }
}
