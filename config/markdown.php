<?php

return [

    /**
     * Options
     *
     * https://commonmark.thephpleague.com/2.0/configuration/
     */
    'options' => [
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

        'html_input' => 'allow',
        'allow_unsafe_links' => false,
        'max_nesting_level' => PHP_INT_MAX,
        'slug_normalizer' => [
            'max_length' => 255,
        ],

        /**
         * Keep in mind that some extensions may have it's own configuration.
         * You can append here those configuration like explained by the example below...
         */

//        // see https://commonmark.thephpleague.com/2.0/extensions/default-attributes/
//        'default_attributes' => [
//            \League\CommonMark\Extension\CommonMark\Node\Block\Heading::class => [
//                'class' => static function (\League\CommonMark\Extension\CommonMark\Node\Block\Heading $node): string | null {
//                    if ($node->getLevel() === 1) {
//                        return 'title-main';
//                    } else {
//                        return null;
//                    }
//                },
//            ],
//            \League\CommonMark\Extension\Table\Table::class => [
//                'class' => 'table',
//            ],
//            \League\CommonMark\Node\Block\Paragraph::class => [
//                'class' => ['text-center', 'font-comic-sans'],
//            ],
//            \League\CommonMark\Extension\CommonMark\Node\Inline\Link::class => [
//                'class' => 'btn btn-link',
//                'target' => '_blank',
//            ],
//        ],
    ],

    /**
     * Extensions
     *
     * `CommonMarkCoreExtension` is loaded by default,
     * follow you can find a list of available extensions.
     *
     * https://commonmark.thephpleague.com/2.0/extensions/overview/
     */
    'extensions' => [
//        \League\CommonMark\Extension\GithubFlavoredMarkdownExtension::class,
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
