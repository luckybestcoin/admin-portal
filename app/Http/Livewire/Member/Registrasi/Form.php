<?php

namespace App\Http\Livewire\Member\Registrasi;

use App\Models\Anggota;
use Livewire\Component;

class Form extends Component
{
    public $uid, $nama, $ktp, $email, $alamat, $no_hp, $paket;

    public $data_member, $data_paket;

    public function mount()
    {
        $this->data_member = Anggota::whereNull('anggota_parent')->get();
    }

    public function render()
    {
        return view('livewire.member.registrasi.form')
        ->extends('livewire.main', [
            'breadcrumb' => ['Member', 'Registrasi'],
            'title' => 'Registrasi Member',
            'description' => 'From Registrasi Member Baru  '
        ])
        ->section('subcontent');
    }
}
