<?php

declare(strict_types=1);

namespace Lemaur\Markdown\Tests;

use Illuminate\View\Component;

class Alert extends Component
{
    public function render(): string
    {
        return <<<'blade'
            <div class="alert alert-danger">
                {{ $slot }}
            </div>
        blade;
    }
}
