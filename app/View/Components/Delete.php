<?php

namespace App\View\Components;

use Illuminate\Translation\Translator;
use Illuminate\View\Component;

class Delete extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $id;
    public $type;
    public $class;
    public $size;
    public $style;
    public $dataid;


    public function __construct(string $id, string $type = "button", string $class = "", string $size = "sm", string $style = "",  $dataid = null)
    {
        $this->id = $id;
        $this->type = $type;
        $this->class = $class;
        $this->size = $size;
        $this->style = $style;
        $this->dataid = $dataid;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.delete');
    }
}
