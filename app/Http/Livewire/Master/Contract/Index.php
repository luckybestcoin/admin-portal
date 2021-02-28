<?php

namespace App\Http\Livewire\Master\Contract;

use App\Models\Contract;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $key, $cari, $error,
            $deleted;

    protected $queryString = ['cari', 'deleted'],
            $paginationTheme = 'bootstrap';

    public function batal(){
        $this->reset('key');
    }

    public function setKey($key){
        $this->key = $key;
    }

    public function hapus(){
        Contract::findOrFail($this->key)->delete();
        $this->batal();
    }

    public function restore(){
        Contract::withTrashed()->findOrFail($this->key)->restore();
        $this->batal();
    }

    public function render()
    {
        $data = Contract::where('contract_name', 'like', '%'.$this->cari.'%');

        if ($this->deleted == 1){
            $data = $data->onlyTrashed();
        }

        $data = $data->paginate(10);
        $this->emit('reinitialize');
        return view('livewire.master.contract.index', [
            'data' => $data,
            'no' => ($this->page - 1) * 10
        ])
        ->extends('livewire.main', [
            'breadcrumb' => ['Master', 'Contract'],
            'title' => 'Contract'
        ])
        ->section('subcontent');
    }
}
