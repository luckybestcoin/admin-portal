<?php

namespace App\Http\Livewire\Member;

use App\Models\Member;
use Livewire\Component;
use App\Models\Referral;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Mail;

class Index extends Component
{
    use WithPagination;

    public $key, $cari, $error,
            $deleted, $notification;

    protected $queryString = ['cari', 'deleted'],
            $paginationTheme = 'bootstrap';

    public function updated()
    {
        $this->notification = null;
    }

    public function referral($id)
    {
        $this->notification = null;
        $member = Member::findOrFail($id);
        $token = Referral::where('member_id', $id)->first();

        Mail::send('email.registration', [
            'token' => $token->referral_token,
            'name' => $member->member_name,
            'contract' => $member->contract_price,
            'email' => $member->member_email
        ], function($message) use($member) {
            $message->to($member->member_email, $member->member_name)->subject
                ('Lucky Best Coin Registration Referral Code');
            $message->from('no-reply@luckybestcoin.net', 'Admin LBC');
        });
        $this->notification = [
            'tipe' => 'success',
            'pesan' => 'Referral has been sent to '.$member->member_email
        ];
    }

    public function render()
    {
        $data = Member::with('referral')->where(fn ($q) => $q->where('member_email', 'like', '%'.$this->cari.'%')->orderBy('member_user')->orWhere('member_user', 'like', '%'.$this->cari.'%'));

        if ($this->deleted == 1){
            $data = $data->where('member_user', '=', null);
        }else{
            $data = $data->where('member_user', '!=', null);
        }

        $data = $data->paginate(10);
        $this->emit('reinitialize');
        return view('livewire.member.index',[
            'data' => $data,
            'no' => ($this->page - 1) * 10
        ])
        ->extends('livewire.main', [
            'breadcrumb' => ['Member', 'Data'],
            'title' => 'Member Data'
        ])
        ->section('subcontent');
    }
}
