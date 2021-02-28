<?php

namespace App\Http\Livewire\Master\Contract;

use App\Models\Paket;
use Illuminate\Support\Str;
use Livewire\Component;

class Form extends Component
{
    public $key, $data, $nama_paket, $harga, $pin, $back;

    protected $rules = [
        'nama_paket' => 'required',
        'harga' => 'required',
        'pin' => 'required|numeric|min:1|max:2'
    ];

    public function mount($key = null){
        $this->back = Str::contains(url()->previous(), ['tambah', 'edit'])? '/datamaster/paket': url()->previous();
        if($key){
            $this->key = $key;
            $this->data = Paket::findOrFail($key);
            $this->nama_paket = $this->data->paket_nama;
            $this->harga = number_format($this->data->paket_harga,2);
            $this->pin = number_format($this->data->paket_pin);
        }
    }

    public function submit() {
        $this->validate();
        if ($this->key){
            $this->data->paket_nama = $this->nama_paket;
            $this->data->paket_harga = $this->harga;
            $this->data->paket_pin = $this->pin;
            $this->data->save();
        }else{
            $data = new Paket();
            $data->paket_nama = $this->nama_paket;
            $data->paket_harga = $this->harga;
            $data->paket_pin = $this->pin;
            $data->save();
        }
        session()->flash('messages', 'Berhasil menyimpan data');
        return $this->redirect($this->back);
    }

    public function render() {
        return view('livewire.master.contract.form')
            ->extends('livewire.main', [
                'breadcrumb' => ['Data Master', 'Paket', ($this->key? 'Edit Data': 'Tambah Data')],
                'title' => ($this->key? 'Edit': 'Tambah').' Paket',
                'description' => 'Tambah data paket member yang tersedia'
            ])
            ->section('subcontent');
    }
}
