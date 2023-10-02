<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormAction extends Component
{
    public $item;
    public $value;
    public function __construct($item,$value)
    {
        $this->item = $item;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.form-action');
    }
}
