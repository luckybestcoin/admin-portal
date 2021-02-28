<?php

namespace App\Http\Livewire\Datamaster\Peringkat;

use App\Models\Peringkat;
use Illuminate\Support\Str;
use Livewire\Component;

class Form extends Component
{
    public $key, $data, $peringkat, $omset_minimal, $bonus, $back;

    protected $rules = [
        'peringkat' => 'required',
        'omset_minimal' => 'required',
        'bonus' => 'required'
    ];

    public function mount($key = null){
        $this->back = Str::contains(url()->previous(), ['tambah', 'edit'])? '/datamaster/peringkat': url()->previous();
        if($key){
            $this->key = $key;
            $this->data = Peringkat::findOrFail($key);
            $this->peringkat = $this->data->peringkat_nama;
            $this->omset_minimal = number_format($this->data->peringkat_omset_min,2);
            $this->bonus = number_format($this->data->peringkat_bonus, 2);
        }
    }

    public function submit() {
        $this->validate();
        if ($this->key){
            $this->data->peringkat_nama = $this->peringkat;
            $this->data->peringkat_omset_min = $this->omset_minimal;
            $this->data->peringkat_bonus = $this->bonus;
            $this->data->save();
        }else{
            $data = new Peringkat();
            $data->peringkat_nama = $this->peringkat;
            $data->peringkat_omset_min = $this->omset_minimal;
            $data->peringkat_bonus = $this->bonus;
            $data->save();
        }
        session()->flash('messages', 'Berhasil menyimpan data');
        return $this->redirect($this->back);
    }

    public function render() {
        return view('livewire.datamaster.peringkat.form')
            ->extends('livewire.main', [
                'breadcrumb' => ['Data Master', 'Peringkat', ($this->key? 'Edit Data': 'Tambah Data')],
                'title' => ($this->key? 'Edit': 'Tambah').' Peringkat',
                'description' => 'Tambah data peringkat member yang tersedia'
            ])
            ->section('subcontent');
    }
}
