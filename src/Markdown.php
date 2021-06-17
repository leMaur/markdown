<?php

declare(strict_types=1);

namespace Lemaur\Markdown;

use Illuminate\Support\HtmlString;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use Lemaur\Markdown\Support\ViewFactory;

class Markdown
{
    public static function render(?string $text = null): HtmlString
    {
        if (is_null($text)) {
            return new HtmlString;
        }

        $environment = Environment::createCommonMarkEnvironment();

        collect(config('markdown.extensions', []))
            ->each(fn ($extension) => $environment->addExtension(new $extension()));

        $converter = new CommonMarkConverter(config('markdown.options', []), $environment);

        $html = $converter->convertToHtml($text);

        return new HtmlString((string) ViewFactory::parse($html));
    }
}
