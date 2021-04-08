<?php

namespace App\Http\Livewire\Member;

use App\Models\Member;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class Edit extends Component
{
    public $key, $data, $back, $notification, $username, $name, $contract, $email, $phone_number, $password;

    protected $rules = [
        'name' => 'required',
        'contract' => 'required',
        'email' => 'required|email',
        'phone_number' => 'required|min:9',
    ];

    public function submit()
    {
        $this->validate();

        $this->reset('notification');
        $error = null;

        try{
            $this->data->member_email = $this->email;
            $this->data->member_phone = $this->phone_number;
            if ($this->password) {
                $this->data->member_password = Hash::make($this->password);
            }
            $this->data->save();

            $this->updated();
            $this->notification = [
                'tipe' => 'success',
                'pesan' => 'Member profile has been updated'
            ];
            return $this->redirect($this->back);
        } catch(\Exception $e){
            return $this->notification = [
                'tipe' => 'danger',
                'pesan' => $e->getMessage()
            ];
        }
    }

    public function mount($key)
    {
        $this->back = Str::contains(url()->previous(), ['add'])? '/reward/daily': url()->previous();
        $this->data = Member::findOrFail($key);
        if ($this->data) {
            $this->username = $this->data->member_user;
            $this->name = $this->data->member_name;
            $this->contract = $this->data->contract->contract_price;
            $this->email = $this->data->member_email;
            $this->phone_number = $this->data->member_phone;
        }
        $this->key = $key;
    }

    public function render()
    {
        return view('livewire.member.edit')
        ->extends('livewire.main', [
            'breadcrumb' => ['Member', 'Data'],
            'title' => 'Member Data'
        ])
        ->section('subcontent');
    }
}
