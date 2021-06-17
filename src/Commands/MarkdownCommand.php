<?php

declare(strict_types=1);

namespace Lemaur\Markdown\Commands;

use Illuminate\Console\Command;

class MarkdownCommand extends Command
{
    public $signature = 'markdown';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
