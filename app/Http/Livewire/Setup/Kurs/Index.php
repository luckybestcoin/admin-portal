<?php

namespace App\Http\Livewire\Setup\Kurs;

use App\Models\Kurs;
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
            Kurs::findOrFail($this->key)->delete();
            $this->batal();
        }

        public function render()
        {
            $data = Kurs::orderBy('kurs_id', 'desc')->paginate(10);
            $this->emit('reinitialize');
            return view('livewire.setup.kurs.index', [
                'data' => $data,
                'no' => ($this->page - 1) * 10
            ])
            ->extends('livewire.main', [
                'breadcrumb' => ['Setup', 'Kurs'],
                'title' => 'Kurs',
                'description' => 'Data kurs yang sudah pernah ditetapkan'
            ])
            ->section('subcontent');
        }
}
