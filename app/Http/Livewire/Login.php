<?php

namespace App\Http\Livewire;

use App\Models\Referal;
use Livewire\Component;
use App\Models\Referral;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Login extends Component
{
    public $user, $password, $referral_token, $remember = false;
    public $notification;

    protected $rules = [
        'user' => 'required',
        'password' => 'required',
    ];

    public function submit()
    {
        $this->validate();

        $remember = $this->remember == 'on';
        if (Auth::attempt(['user_nick' => $this->user, 'password' => $this->password], $remember)) {
            Auth::logoutOtherDevices($this->password, 'user_password');
            return redirect()->intended('dashboard');
        }
        $this->notification = [
            'tipe' => 'danger',
            'pesan' => '<li><strong>Sign In notification!!!</strong><br>Wrong user or password</li>'
        ];
        return;
    }

    public function updated()
    {
        $this->reset('notification');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
