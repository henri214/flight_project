<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class FormSelect extends Component
{
    public $input = '';
    public Collection $items;
    public $description = '';
    public function __construct($input, $description, $items = new Collection)
    {
        $this->input = $input;
        $this->description = $description;
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.form-select');
    }
}
