<?php

namespace App\Http\Livewire\Setup\Rate;

use App\Models\Rate;
use Livewire\Component;
use Illuminate\Support\Str;

class Form extends Component
{
    public $price, $datetime, $notification, $back;

    protected $rules = [
        'price' => 'required',
        'datetime' => 'required'
    ];

    public function mount()
    {
        $this->back = Str::contains(url()->previous(), ['add'])? '/setup/rate': url()->previous();
        $this->datetime = (string)date('Y-m-d h:m:s');
    }

    protected $listeners = [
        'set:setdatetime' => 'setDatetime'
    ];

    public function setDatetime($data)
    {
        $this->datetime = $data;
    }

    public function submit()
    {
        $this->emit('reinitialize');
        $this->validate();

        $this->reset('notification');

        try{
            $data = new Rate();
            $data->rate_price = $this->price;
            $data->rate_currency = 'USD';
            $data->created_at = $this->datetime;
            $data->updated_at = $this->datetime;
            $data->save();

            return $this->redirect($this->back);
        } catch(\Exception $e){
            return $this->notification = [
                'tipe' => 'danger',
                'pesan' => $e->getMessage()
            ];
        }
    }

    public function render()
    {
        return view('livewire.setup.rate.form')
        ->extends('livewire.main', [
            'breadcrumb' => ['Setup', 'Rate', 'Add'],
            'title' => 'Add LBC Rate'
        ])
        ->section('subcontent');
    }
}
