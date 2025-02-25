<?php

namespace App\OCms\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageBuilder extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public array $blocks) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('ocms.components.page-builder');
    }
}
