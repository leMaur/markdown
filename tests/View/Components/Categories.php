<?php

declare(strict_types=1);

namespace Lemaur\Markdown\Tests\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class Categories extends Component
{
    public function render(): View
    {
        return view(base_path('tests/resources/views/components/categories'), [
            'categories' => $this->categories(),
        ]);
    }

    private function categories(): Collection
    {
        return collect(['one', 'two', 'three']);
    }
}
