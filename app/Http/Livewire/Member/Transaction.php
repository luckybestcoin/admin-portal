<?php

namespace App\Http\Livewire\Member;

use App\Models\Member;
use Livewire\Component;

class Transaction extends Component
{
    public $member, $data, $data_member, $limit = 100, $skip = 0;

    public function mount()
    {
        $this->data_member = Member::whereNotNull('app_key')->groupBy('app_key')->get();
        $this->data = [];
    }

    public function setTransaction()
    {
        $this->data = collect($this->member? bitcoind()->listtransactions($this->member, (int)$this->limit, (int)$this->skip)->result(): []);
    }

    public function updated()
    {
        $this->setTransaction();
    }

    public function render()
    {
        $this->emit('reinitialize');
        return view('livewire.member.transaction')
        ->extends('livewire.main', [
            'breadcrumb' => ['Member', 'Transaction'],
            'title' => 'Member Transaction'
        ])
        ->section('subcontent');
    }
}
