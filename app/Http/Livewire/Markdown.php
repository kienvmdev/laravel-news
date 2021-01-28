<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Markdown extends Component
{
    public $content = '';

    public function render()
    {
        return view('livewire.markdown');
    }
}
