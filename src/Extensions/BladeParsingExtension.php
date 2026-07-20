<?php

declare(strict_types=1);

namespace Lemaur\Markdown\Extensions;

use Illuminate\Support\Facades\Blade;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Environment\EnvironmentInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Event\DocumentRenderedEvent;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\HtmlBlock;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use League\CommonMark\Extension\CommonMark\Node\Inline\HtmlInline;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Node\Node;
use League\CommonMark\Output\RenderedContent;
use League\CommonMark\Renderer\HtmlRenderer;

use function assert;

/**
 * Runs Blade over the rendered Markdown so that Blade components (`<x-...>`)
 * are resolved, while protecting code blocks from the Blade compiler.
 *
 * Code nodes (fenced, indented, inline) are pulled out of the document and
 * replaced with UUID placeholders BEFORE Blade runs, then their pre-rendered
 * HTML is restored afterwards. This keeps Blade-looking code samples
 * (`@php`, `{{ $var }}`, `<x-alert>`) displayed as literal text instead of
 * being executed.
 */
final class BladeParsingExtension implements ExtensionInterface
{
    private const PLACEHOLDER = '[[blade-protect:%s]]';

    private EnvironmentInterface $environment;

    /**
     * Pre-rendered code-node HTML, keyed by placeholder id.
     *
     * @var array<string, string>
     */
    private array $rendered = [];

    public function register(EnvironmentBuilderInterface $environment): void
    {
        // The concrete Environment implements both interfaces; the renderer needs the reader side.
        assert($environment instanceof EnvironmentInterface);
        $this->environment = $environment;

        $environment->addEventListener(DocumentParsedEvent::class, [$this, 'onDocumentParsed'], -10);
        $environment->addEventListener(DocumentRenderedEvent::class, [$this, 'onDocumentRendered'], 10);
    }

    public function onDocumentParsed(DocumentParsedEvent $event): void
    {
        // Start clean so a reused extension instance never carries state between documents.
        $this->rendered = [];

        $renderer = new HtmlRenderer($this->environment);

        // A per-document random nonce keeps placeholders unpredictable (document
        // content can never spoof one) and collision-free, without relying on the
        // globally-overridable/freezeable Str::uuid() helper.
        $nonce = bin2hex(random_bytes(8));
        $index = 0;

        // Collect first, then mutate: replacing nodes while iterating is fragile.
        $codeNodes = [];
        foreach ($event->getDocument()->iterator() as $node) {
            if ($this->isCodeNode($node)) {
                $codeNodes[] = $node;
            }
        }

        foreach ($codeNodes as $node) {
            $id = $nonce.'-'.$index++;
            $this->rendered[$id] = (string) $renderer->renderNodes([$node]);

            $node->replaceWith($this->placeholderFor($node, sprintf(self::PLACEHOLDER, $id)));
        }
    }

    public function onDocumentRendered(DocumentRenderedEvent $event): void
    {
        // deleteCachedView (3rd arg) stops Laravel from accumulating one compiled
        // view file per distinct document; it still uses the compiled-view cache
        // during the render itself.
        $content = Blade::render($event->getOutput()->getContent(), [], true);

        if ($this->rendered !== []) {
            $replacements = [];
            foreach ($this->rendered as $id => $html) {
                $replacements[sprintf(self::PLACEHOLDER, $id)] = $html;
            }

            // strtr swaps every placeholder in a single pass, so a restored code
            // block can never be re-scanned for another block's placeholder.
            $content = strtr($content, $replacements);
        }

        // Reset so a reused extension instance never leaks placeholders across renders.
        $this->rendered = [];

        $event->replaceOutput(new RenderedContent($event->getOutput()->getDocument(), $content));
    }

    private function isCodeNode(Node $node): bool
    {
        return $node instanceof FencedCode
            || $node instanceof IndentedCode
            || $node instanceof Code;
    }

    private function placeholderFor(Node $node, string $literal): Node
    {
        if ($node instanceof Code) {
            return new HtmlInline($literal);
        }

        $placeholder = new HtmlBlock(HtmlBlock::TYPE_7_MISC_ELEMENT);
        $placeholder->setLiteral($literal);

        return $placeholder;
    }
}
