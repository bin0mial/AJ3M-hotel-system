<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    private $name, $required, $type, $placeholder, $value;

    public function __construct($name, $type, $placeholder, $value = '', $required = false)
    {
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->required = $required;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input', [
            "name" => $this->name, "type" => $this->type, "placeholder" => $this->placeholder,
            "value" => $this->value, "required" => $this->required]);
    }
}
