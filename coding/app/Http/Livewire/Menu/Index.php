<?php

namespace App\Http\Livewire\Menu;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.menu.index')->layout('page.v_menu');
    }
}
