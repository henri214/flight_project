<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormRestore extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $item;
    public function __construct($name,$item) {
        $this->name = $name;
        $this->item = $item;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.form-restore');
    }
}
