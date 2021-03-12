<?php

namespace App\Http\Livewire\Setup\Rate;

use App\Models\Rate;
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
        Rate::findOrFail($this->key)->delete();
        $this->batal();
    }

    public function render()
    {
        $data = Rate::where('created_at', 'like', '%'.$this->cari.'%');

        if ($this->deleted == 1){
            $data = $data->onlyTrashed();
        }

        $data = $data->orderBy('created_at', 'desc')->paginate(10);
        $this->emit('reinitialize');
        return view('livewire.setup.rate.index', [
            'data' => $data,
            'no' => ($this->page - 1) * 10
        ])
        ->extends('livewire.main', [
            'breadcrumb' => ['Setup', 'Rate'],
            'title' => 'LBC Rate'
        ])
        ->section('subcontent');
    }
}
