<?php

namespace App\Http\Livewire\Member;

use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $key, $cari, $error,
            $deleted;

    protected $queryString = ['cari', 'deleted'],
            $paginationTheme = 'bootstrap';

    public function referral($id)
    {
        # code...
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
