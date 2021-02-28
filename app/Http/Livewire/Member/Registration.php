<?php

namespace App\Http\Livewire\Member;

use App\Models\Member;
use App\Models\Anggota;
use App\Models\Country;
use Livewire\Component;
use App\Models\Contract;
use App\Models\Referral;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Registration extends Component
{

    public $name, $contract, $country, $phone_number, $email, $back, $notification, $contract_pin, $contract_name, $country_code, $rate, $contract_price = 0;

    public $country_data = [], $contract_data = [], $member_data = [];

    protected $rules = [
        'name' => 'required',
        'contract' => 'required',
        'email' => 'required|email',
        'phone_number' => 'required|min:9',
        'country' => 'required'
    ];

    protected $listeners = [
        'set:setcontract' => 'setContract',
        'set:setcountry' => 'setCountry'
    ];

    public function setCountry($country)
    {
        $this->updated();
        $this->country = $country;
        $country_filter = $this->country_data->where('country_id', $country)->first();
        $this->country_code = $country_filter['country_code'];
    }

    public function setContract($contract)
    {
        $this->updated();
        if ($contract) {
            $this->contract = $contract;
            $contract_filter = $this->contract_data->where('contract_id', $contract)->first();
            $this->contract_price = $contract_filter['contract_price'];
            $this->contract_pin = $contract_filter['contract_pin'];
            $this->contract_name = $contract_filter['contract_name'];
        } else {
            $this->reset(['contract']);
        }
    }

    public function updated()
    {
        $this->emit('reinitialize');
        $this->reset('notification');
    }

    public function mount()
    {
        $this->updated();
        $this->back = Str::contains(url()->previous(), ['add', 'edit'])? '/Member/registration': url()->previous();
        $this->country_data = Country::orderBy('country_name')->get();
        $this->contract_data = Contract::all();
    }

    public function countryChanged()
    {
        $this->showTable = 1;
    }

    public function submit()
    {
        $this->emit('reinitialize');
        $this->validate();

        $this->reset('notification');
        $error = null;

        try{
            if (Member::where('member_email', $this->email)->count() > 0){
                $error .= "<li>The email address <strong>".$this->email."</strong> is already registered</li>";
            }
            if (Member::where('member_phone', $this->phone_number)->count() > 0){
                $error .= "<li>The phone nomber <strong>".$this->phone_number."</strong> is already registered</li>";
            }
            if ($error) {
                return $this->notification = [
                    'tipe' => 'danger',
                    'pesan' => $error
                ];
            }

            DB::transaction(function () {
                $member = new Member();
                $member->member_name = $this->name;
                $member->member_email = $this->email;
                $member->country_id = $this->country;
                $member->contract_id = $this->contract;
                $member->contract_price = $this->contract_price;
                $member->member_phone = $this->country_code.$this->phone_number;
                $member->member_network = '';
                $member->save();

                $referral = new Referral();
                $referral->referral_token = Str::random(40).$member->member_id;
                $referral->member_id = $member->member_id;
                $referral->save();

                Mail::send('email.registration', [
                    'token' => $referral->referral_token,
                    'name' => $this->name,
                    'contract' => $this->contract,
                    'email' => $this->email
                ], function($message) {
                    $message->to($this->email, $this->name)->subject
                        ('Lucky Best Coin Registration Referral Code');
                    $message->from('no-reply@luckybestcoin.com', 'Admin LBC');
                });
            });

            $this->updated();
            $this->notification = [
                'tipe' => 'success',
                'pesan' => 'New member registration is successful. An email has been sent to '.$this->email
            ];
            return $this->reset(['name', 'email', 'country', 'contract', 'phone_number']);
        } catch(\Exception $e){
            return $this->notification = [
                'tipe' => 'danger',
                'pesan' => $e->getMessage()
            ];
        }
    }

    public function render()
    {
        return view('livewire.member.registration')
        ->extends('livewire.main', [
            'breadcrumb' => ['Member', 'Registration'],
            'title' => 'Member Registration'
        ])
        ->section('subcontent');
    }
}
