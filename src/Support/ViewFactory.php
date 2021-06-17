<?php

namespace Lemaur\Markdown\Support;

use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ViewFactory
{
    protected View $view;

    protected string $rendered;

    public function __construct(View $view)
    {
        $this->view = $view;
        $this->rendered = $view->render();
    }

    public function __toString(): string
    {
        return $this->rendered;
    }

    public static function parseComponent(string $template, array $data = []): self
    {
        $tempDirectory = sys_get_temp_dir();

        if (! in_array($tempDirectory, ViewFacade::getFinder()->getPaths(), true)) {
            ViewFacade::addLocation(sys_get_temp_dir());
        }

        $tempFile = tempnam($tempDirectory, 'laravel-blade') . '.blade.php';

        file_put_contents($tempFile, $template);

        return new ViewFactory(view(Str::before(basename($tempFile), '.blade.php'), $data));
    }
}
