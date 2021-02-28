<?php

namespace App\Http\Livewire\Datamaster\Paket;

use App\Models\Paket;
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
            Paket::findOrFail($this->key)->delete();
            $this->batal();
        }

        public function restore(){
            Paket::withTrashed()->findOrFail($this->key)->restore();
            $this->batal();
        }

        public function render()
        {
            $data = Paket::where('paket_nama', 'like', '%'.$this->cari.'%');

            if ($this->deleted == 1){
                $data = $data->onlyTrashed();
            }

            $data = $data->paginate(10);
            $this->emit('reinitialize');
            return view('livewire.datamaster.paket.index', [
                'data' => $data,
                'no' => ($this->page - 1) * 10
            ])
            ->extends('livewire.main', [
                'breadcrumb' => ['Data Master', 'Paket'],
                'title' => 'Paket',
                'description' => 'Data paket member yang tersedia'
            ])
            ->section('subcontent');
        }
}
