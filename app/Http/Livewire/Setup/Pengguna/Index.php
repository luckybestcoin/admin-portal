<?php

namespace App\Http\Livewire\Setup\Pengguna;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.setup.pengguna.index')
        ->extends('livewire.main')
        ->section('subcontent');
    }
}
