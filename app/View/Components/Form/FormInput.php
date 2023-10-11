<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInput extends Component
{
    /**
     * Create a new component instance.
     */
    public $input = '';
    public $type = '';
    public $id;
    public $min;
    public $max;
    public function __construct($input, $type, $min = '', $max = '', $id = '')
    {
        $this->input = $input;
        $this->type = $type;
        $this->id = $id;
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.form-input');
    }
}
