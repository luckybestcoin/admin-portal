<?php

namespace App\Http\Livewire\Setup\Harilibur;

use App\Models\HariLibur;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $key, $cari, $error;

    protected $queryString = ['cari'],
            $paginationTheme = 'bootstrap';

    public function batal(){
        $this->reset('key');
    }

    public function setKey($key){
        $this->key = $key;
    }

    public function hapus(){
        HariLibur::findOrFail($this->key)->delete();
        $this->batal();
    }

    public function render()
    {
        $data = HariLibur::where('hari_libur_keterangan', 'like', '%'.$this->cari.'%')->paginate(10);
        $this->emit('reinitialize');
        return view('livewire.setup.harilibur.index', [
            'data' => $data,
            'no' => ($this->page - 1) * 10
        ])
        ->extends('livewire.main', [
            'breadcrumb' => ['Data Master', 'Hari Libur'],
            'title' => 'Hari Libur',
            'description' => 'Hari libur sesuai kalender'
        ])
        ->section('subcontent');
    }
}
