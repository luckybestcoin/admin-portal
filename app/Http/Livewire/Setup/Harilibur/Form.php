<?php

namespace App\Http\Livewire\Setup\Harilibur;

use App\Models\HariLibur;
use Illuminate\Support\Str;
use Livewire\Component;

class Form extends Component
{
    public $key, $data, $tanggal, $keterangan, $back;

    protected $rules = [
        'tanggal' => 'required',
        'keterangan' => 'required',
    ];

    public function mount($key = null){
        $this->back = Str::contains(url()->previous(), ['tambah', 'edit'])? '/setup/harilibur': url()->previous();
        if($key){
            $this->key = $key;
            $this->data = HariLibur::findOrFail($key);
            $this->tanggal = $this->data->hari_libur_tanggal;
            $this->keterangan = $this->data->hari_libur_keterangan;
        }
    }

    public function submit() {
        $this->validate();
        if ($this->key){
            $this->data->hari_libur_tanggal = $this->tanggal;
            $this->data->hari_libur_keterangan = $this->keterangan;
            $this->data->save();
        }else{
            $data = new HariLibur();
            $data->hari_libur_tanggal = $this->tanggal;
            $data->hari_libur_keterangan = $this->keterangan;
            $data->save();
        }
        session()->flash('messages', 'Berhasil menyimpan data');
        return $this->redirect($this->back);
    }

    public function render() {
        return view('livewire.setup.harilibur.form')
            ->extends('livewire.main', [
                'breadcrumb' => ['Data Master', 'Hari Libur', ($this->key? 'Edit Data': 'Tambah Data')],
                'title' => ($this->key? 'Edit': 'Tambah').' Hari Libur',
                'description' => 'Tambah data hari libur sesuai kalender'
            ])
            ->section('subcontent');
    }
}
