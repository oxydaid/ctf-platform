<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app.blank')] 
class Home extends Component
{
    public function render()
    {
        return view('livewire.home');
    }
}
