<?php

namespace App\Http\Livewire\Member;

use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;

class Appkey extends Component
{
    use WithPagination;

    public $key, $cari, $error,
            $deleted;

    protected $queryString = ['cari', 'deleted'],
            $paginationTheme = 'bootstrap';

    public function cancel(){
        $this->reset('key');
    }

    public function setKey($key){
        $this->key = $key;
    }

    public function clear()
    {
        Member::where('member_id', $this->key)->update([
           'username' => null,
           'app_key' => null,
           'address' => null
        ]);
    }

    public function render()
    {
        $data = Member::with('referral')->whereNotNull('username')->where(fn ($q) => $q->where('member_email', 'like', '%'.$this->cari.'%')->orWhere('member_user', 'like', '%'.$this->cari.'%'))->orderBy('member_user')->paginate(10);
        $this->emit('reinitialize');
        return view('livewire.member.appkey',[
            'data' => $data,
            'no' => ($this->page - 1) * 10
        ])
        ->extends('livewire.main', [
            'breadcrumb' => ['Member', 'App Key'],
            'title' => 'App Key'
        ])
        ->section('subcontent');
    }
}
