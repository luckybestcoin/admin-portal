<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;

class Transactionhistory extends Component
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

    public function delete(){
        Transaction::where('transaction_id', $this->key)->delete();
        $this->cancel();
    }

    public function render()
    {
        $data = Transaction::where('transaction_information', 'like', '%'.$this->cari.'%')->orderBy('created_at', 'desc')->paginate(10);
        $this->emit('reinitialize');
        return view('livewire.transactionhistory', [
            'data' => $data,
            'no' => ($this->page - 1) * 10
        ])
        ->extends('livewire.main', [
            'breadcrumb' => ['Transaction History'],
            'title' => 'Transaction History'
        ])
        ->section('subcontent');
    }
}
