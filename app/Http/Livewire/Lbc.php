<?php

namespace App\Http\Livewire;

use App\Models\Rate;
use App\Models\Member;
use App\Models\Wallet;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class Lbc extends Component
{
    public $address, $amount, $destination, $notification, $password, $member_data;

    protected $rules = [
        'destination' => 'required',
        'amount' => 'required',
        'password' => 'required'
    ];

    protected $listeners = [
        'set:setdestination' => 'setDestination'
    ];

    public function setDestination($destination)
    {
        dd($destination);
        $this->updated();
        $this->destination = $destination;
    }

    public function mount()
    {
        $this->member_data = Member::whereNotNull('app_key')->get();
    }

    public function updated()
    {
        $this->emit('reinitialize');
        // $this->validate();
    }

    public function show()
    {
        $this->reset(['destination', 'password', 'amount', 'notification']);
        $this->emit('show');
    }

    public function submit()
    {
        $this->validate();

        $error = null;
        $this->amount = (float)$this->amount;
        $this->reset('notification');

        try {
            if(Str::length($this->destination)){
                $error .= "<li>Destination has not been selected</li>";
            }

            if(Hash::check($this->password, auth()->user()->user_password) === false){
                $error .= "<li>Wrong <strong>password</strong></li>";
            }

            if ($this->amount <= 0) {
                $error .= "<li>LBC amount to be purchased cannot be less than 1</li>";
            }

            if($this->lbc_amount > bitcoind()->getbalance('administrator')[0]){
                $error .= "<li>Account has insufficient funds.</li>";
            }

            if ($error) {
                $this->reset(['destination', 'amount', 'password']);
                return $this->notification = [
                    'tipe' => 'danger',
                    'pesan' => $error
                ];
            }
            bitcoind()->move("administrator", $this->destination, $this->lbc_amount, 8, 1, "Deposit");

            $this->reset(['destination', 'password', 'amount']);
            $this->emit('done');
            return $this->notification = [
                'tipe' => 'success',
                'pesan' => 'Send LBC was successful!!!'
            ];
		} catch(\Exception $e){
            return $this->notification = [
                'tipe' => 'danger',
                'pesan' => $e->getMessage()
            ];
        }
    }

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
