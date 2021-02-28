<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard')
        ->extends('livewire.main', [
            'breadcrumb' => [],
            'title' => 'Dashboard',
            'description' => 'Main Page'
        ])
        ->section('subcontent');
    }
}
