<?php

return [

    /**
     * Options
     *
     * https://commonmark.thephpleague.com/1.6/configuration/
     */
    'options' => [
        'html_input' => \League\CommonMark\EnvironmentInterface::HTML_INPUT_ALLOW,
        'allow_unsafe_links' => false,
        'max_nesting_level' => PHP_INT_MAX,

        'renderer' => [
            'block_separator' => "\n",
            'inner_separator' => "\n",
            'soft_break'      => "\n",
        ],

        'commonmark' => [
            'enable_em' => true,
            'enable_strong' => true,
            'use_asterisk' => true,
            'use_underscore' => true,
            'unordered_list_markers' => ['-', '*', '+'],
        ],

        'external_link' => [
            'internal_hosts' => env('APP_URL'),
            'open_in_new_window' => true,
            'html_class' => 'external-link',
            'nofollow' => '',
            'noopener' => 'external',
            'noreferrer' => 'external',
        ],

        'footnote' => [
            'backref_class'      => 'footnote-backref',
            'container_add_hr'   => true,
            'container_class'    => 'footnotes',
            'ref_class'          => 'footnote-ref',
            'ref_id_prefix'      => 'fnref:',
            'footnote_class'     => 'footnote',
            'footnote_id_prefix' => 'fn:',
        ],

        'heading_permalink' => [
            'html_class' => 'heading-permalink',
            'id_prefix' => 'user-content',
            'insert' => 'before',
            'title' => 'Permalink',
            'symbol' => \League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkRenderer::DEFAULT_SYMBOL,
            'slug_normalizer' => new \League\CommonMark\Normalizer\SlugNormalizer(),
        ],

        'mentions' => [
            // GitHub handler mention configuration.
            // Sample Input:  `@colinodell`
            // Sample Output: `<a href="https://www.github.com/colinodell">@colinodell</a>`
//            'github_handle' => [
//                'prefix'    => '@',
//                'pattern'   => '[a-z\d](?:[a-z\d]|-(?=[a-z\d])){0,38}(?!\w)',
//                'generator' => 'https://github.com/%s',
//            ],

            // GitHub issue mention configuration.
            // Sample Input:  `#473`
            // Sample Output: `<a href="https://github.com/thephpleague/commonmark/issues/473">#473</a>`
//            'github_issue' => [
//                'prefix'    => '#',
//                'pattern'   => '\d+',
//                'generator' => "https://github.com/thephpleague/commonmark/issues/%d",
//            ],

            // Twitter handler mention configuration.
            // Sample Input:  `@colinodell`
            // Sample Output: `<a href="https://www.twitter.com/colinodell">@colinodell</a>`
            // Note: when registering more than one mention parser with the same prefix, the last one registered will
            // always take precedence.
            'twitter_handle' => [
                'prefix'    => '@',
                'pattern'   => '[A-Za-z0-9_]{1,15}(?!\w)',
                'generator' => 'https://twitter.com/%s',
            ],
        ],

        'smartpunct' => [
            'double_quote_opener' => '“',
            'double_quote_closer' => '”',
            'single_quote_opener' => '‘',
            'single_quote_closer' => '’',
        ],

        'table_of_contents' => [
            'html_class' => 'table-of-contents',
            'position' => 'top',
            'style' => 'bullet',
            'min_heading_level' => 1,
            'max_heading_level' => 6,
            'normalize' => 'relative',
            'placeholder' => null,
        ],

    ],

    /**
     * Extensions
     *
     * https://commonmark.thephpleague.com/1.6/extensions/overview/
     */
    'extensions' => [
        \League\CommonMark\Extension\CommonMarkCoreExtension::class,
//        \League\CommonMark\Extension\Attributes\AttributesExtension::class,
//        \League\CommonMark\Extension\Autolink\AutolinkExtension::class,
//        \League\CommonMark\Extension\DisallowedRawHtml\DisallowedRawHtmlExtension::class,
//        \League\CommonMark\Extension\ExternalLink\ExternalLinkExtension::class,
//        \League\CommonMark\Extension\Footnote\FootnoteExtension::class,
//        \League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension::class,
//        \League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkRenderer::class,
//        \League\CommonMark\Extension\InlinesOnly\InlinesOnlyExtension::class,
//        \League\CommonMark\Extension\Mention\MentionExtension::class,
//        \League\CommonMark\Extension\SmartPunct\SmartPunctExtension::class,
//        \League\CommonMark\Extension\Strikethrough\StrikethroughExtension::class,
//        \League\CommonMark\Extension\TableOfContents\TableOfContentsExtension::class, // Needs `HeadingPermalinkExtension::class`
//        \League\CommonMark\Extension\Table\TableExtension::class,
//        \League\CommonMark\Extension\TaskList\TaskListExtension::class, // Please note that this extension does not provide any JavaScript functionality to handle people checking and unchecking boxes - you’ll need to implement that yourself if needed.
    ],
];
