<?php

namespace App\View\Components\partner;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class partnerSection extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.partner.partner-section');
    }
}
