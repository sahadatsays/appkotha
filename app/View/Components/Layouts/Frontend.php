<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;
use Illuminate\View\View;

class Frontend extends Component
{
    public function __construct(
        public ?string $title = null,
        public ?string $metaDescription = null,
        public ?string $metaKeywords = null,
    ) {}

    public function render(): View
    {
        return view('layouts.frontend');
    }
}
