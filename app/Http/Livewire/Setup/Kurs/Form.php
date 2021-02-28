<?php

namespace App\Http\Livewire\Setup\Kurs;

use App\Models\Kurs;
use Illuminate\Support\Str;
use Livewire\Component;

class Form extends Component
{
    public $key, $data, $kurs_beli, $kurs_jual, $back;

    protected $rules = [
        'kurs_beli' => 'required',
        'kurs_jual' => 'required'
    ];

    public function mount($key = null){
        $this->back = Str::contains(url()->previous(), ['tambah', 'edit'])? '/setup/kurs': url()->previous();
    }

    public function submit() {
        $this->validate();
        $data = new Kurs();
        $data->kurs_beli = $this->kurs_beli;
        $data->kurs_jual = $this->kurs_jual;
        $data->save();
        session()->flash('messages', 'Berhasil menyimpan data');
        return $this->redirect('kurs');
    }

    public function render() {
        return view('livewire.setup.kurs.form')
            ->extends('livewire.main', [
                'breadcrumb' => ['Setup', 'Kurs', ($this->key? 'Edit Data': 'Tambah Data')],
                'title' => 'Input Kurs',
                'description' => 'Input kurs terbaru'
            ])
            ->section('subcontent');
    }
}
