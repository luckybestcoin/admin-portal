<?php

namespace App\Http\Livewire;

use App\Models\Rate;
use App\Models\Member;
use App\Models\Wallet;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class Lbc extends Component
{
    public $address, $transaction, $balance, $amount, $destination, $notification, $password, $member_data;

    protected $rules = [
        'destination' => 'required',
        'amount' => 'required',
        'password' => 'required'
    ];

    public function mount()
    {
        $this->member_data = Member::whereNotNull('member_password')->get();
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

            if(Hash::check($this->password, auth()->user()->user_password) === false){
                $error .= "<li>Wrong <strong>password</strong></li>";
            }

            if ($this->amount <= 0) {
                $error .= "<li>LBC amount to be purchased cannot be less than 1</li>";
            }

            $balance = Http::get(config("constant.api")."balance", [
                'user' => auth()->user()->user_nick
            ]);
            if ($this->amount > $balance['status']){
                $error .= "<li>Account has insufficient funds.</li>";
            }

            if ($error) {
                $this->reset(['destination', 'amount', 'password']);
                return $this->notification = [
                    'tipe' => 'danger',
                    'pesan' => $error
                ];
            }

            $send = Http::post(config("constant.api")."send", [
                'source' => auth()->user()->user_nick,
                'destination' => $this->destination,
                'amount' => $this->amount,
                'note' => 'Deposit',
            ]);

            $this->reset(['destination', 'password', 'amount']);
            if ($send['status'] == 'OK') {
                $this->emit('done');
                return $this->notification = [
                    'tipe' => 'success',
                    'pesan' => 'Send LBC was successful!!!'
                ];
            }else{
                return $this->notification = [
                    'tipe' => 'danger',
                    'pesan' => $send['status']
                ];
            }
		} catch(\Exception $e){
            return $this->notification = [
                'tipe' => 'danger',
                'pesan' => $e->getMessage()
            ];
        }
    }

    public function render()
    {
        $balance = Http::get(config("constant.api")."balance", [
            'user' => auth()->user()->user_nick
        ]);
        $transaction = Http::get(config("constant.api")."transaction", [
            'user' => auth()->user()->user_nick
        ]);
        $this->balance = $balance['status'];
        $this->transaction = collect($transaction['status']);
        return view('livewire.lbc')
            ->extends('livewire.main', [
                'breadcrumb' => ['Wallet'],
                'title' => 'Wallet'
            ])
            ->section('subcontent');
    }
}
