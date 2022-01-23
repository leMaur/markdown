<?php

declare(strict_types=1);

namespace Lemaur\Markdown;

use Illuminate\Support\HtmlString;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;
use Lemaur\Markdown\Support\ViewFactory;

class Markdown
{
    public static function render(?string $text = null): HtmlString
    {
        if (is_null($text)) {
            return new HtmlString;
        }

        $environment = new Environment((array) config('markdown.options', []));
        $environment->addExtension(new CommonMarkCoreExtension());

        collect((array) config('markdown.extensions', []))
            ->each(fn ($extension) => $environment->addExtension(new $extension()));

        $converter = new MarkdownConverter($environment);
        $html = $converter->convert($text)->getContent();

        return new HtmlString((string) ViewFactory::parse($html));
    }
}
