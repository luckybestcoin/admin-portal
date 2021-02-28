<?php

namespace App\Http\Livewire\Datamaster\Peringkat;

use App\Models\Peringkat;
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
        Peringkat::findOrFail($this->key)->delete();
        $this->batal();
    }

    public function restore(){
        Peringkat::withTrashed()->findOrFail($this->key)->restore();
        $this->batal();
    }

    public function render()
    {
        $data = Peringkat::where('peringkat_nama', 'like', '%'.$this->cari.'%');

        if ($this->deleted == 1){
            $data = $data->onlyTrashed();
        }

        $data = $data->paginate(10);
        $this->emit('reinitialize');
        return view('livewire.datamaster.peringkat.index', [
            'data' => $data,
            'no' => ($this->page - 1) * 10
        ])
        ->extends('livewire.main', [
            'breadcrumb' => ['Data Master', 'Peringkat'],
            'title' => 'Peringkat',
            'description' => 'Data peringkat member yang tersedia'
        ])
        ->section('subcontent');
    }
}
