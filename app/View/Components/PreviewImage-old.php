<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PreviewImage extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $idForm;

    public function __construct(string $idForm)
    {
        $this->idForm = $idForm;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.preview-image');
    }
}
