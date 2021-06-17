<?php

declare(strict_types=1);

namespace Lemaur\Markdown;

use Illuminate\Support\HtmlString;
use League\CommonMark\Environment;
use League\CommonMark\MarkdownConverter;
use Lemaur\Markdown\Support\ViewFactory;

class Markdown
{
    public static function render(?string $text = null): HtmlString
    {
        if (is_null($text)) {
            return new HtmlString;
        }

        $environment = new Environment();

        collect((array) config('markdown.extensions', []))
            ->each(fn ($extension) => $environment->addExtension(new $extension()));

        $environment->mergeConfig((array) config('markdown.options', []));

        $converter = new MarkdownConverter($environment);

        $html = $converter->convertToHtml($text);

        return new HtmlString((string) ViewFactory::parse($html));
    }
}
