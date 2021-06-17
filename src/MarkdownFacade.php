<?php

namespace Lemaur\Markdown;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lemaur\Markdown\Markdown
 */
class MarkdownFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'markdown';
    }
}
