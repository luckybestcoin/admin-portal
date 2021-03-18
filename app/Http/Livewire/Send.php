<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\TransactionDeposit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Send extends Component
{
    public $address, $amount, $destination, $notification, $password, $member_data;

    protected $rules = [
        'destination' => 'required',
        'amount' => 'required',
        'password' => 'required'
    ];

    public function updated()
    {
        $this->emit('reinitialize');
        $this->reset('notification');
    }

    public function mount()
    {
        $this->member_data = Member::whereNotNull('app_key')->get();
    }

    public function submit()
    {
        $this->emit('reinitialize');
        $this->validate();

        $error = null;
        $this->reset('notification');

        try {
            if(Str::length($this->destination) == 0){
                $error .= "<li>Destination has not been selected</li>";
            }

            if(Hash::check($this->password, auth()->user()->user_password) === false){
                $error .= "<li>Wrong <strong>password</strong></li>";
            }

            if ($this->amount <= 0) {
                $error .= "<li>LBC amount to be purchased cannot be less than 1</li>";
            }

            if($this->amount > bitcoind()->getbalance('administrator')[0]){
                $error .= "<li>Account has insufficient funds.</li>";
            }

            if ($error) {
                $this->reset(['destination', 'amount', 'password']);
                return $this->notification = [
                    'tipe' => 'danger',
                    'pesan' => $error
                ];
            }

            DB::transaction(function () {
                $id = bitcoind()->getaccountaddress("administrator").date('Ymdhis').round(microtime(true) * 1000);

                $trx = new Transaction();
                $trx->transaction_id = $id;
                $trx->transaction_information = "Deposit ".(Member::where('username', $this->destination)->get()->first()->member_user)." (".$this->amount." LBC)";
                $trx->save();

                $deposit = new TransactionDeposit();
                $deposit->transaction_id = $id;
                $deposit->transaction_deposit_information = "Deposit ".(Member::where('username', $this->destination)->get()->first()->member_user)." (".$this->amount." LBC)";
                $deposit->transaction_deposit_lbc_amount = $this->amount;
                $deposit->save();
                bitcoind()->move("administrator", $this->destination, $this->amount, 1, "Deposit");
            });

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
        $this->emit('reinitialize');
        return view('livewire.send')
            ->extends('livewire.main', [
                'breadcrumb' => ['Wallet', 'Send'],
                'title' => 'Send LBC'
            ])
            ->section('subcontent');
    }
}
