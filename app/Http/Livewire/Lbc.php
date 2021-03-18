<?php

namespace App\Http\Livewire;

use App\Models\Rate;
use App\Models\Member;
use App\Models\Wallet;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Lbc extends Component
{
    public function render()
    {
        return view('livewire.lbc')
            ->extends('livewire.main', [
                'breadcrumb' => ['Wallet'],
                'title' => 'Wallet'
            ])
            ->section('subcontent');
    }
}
