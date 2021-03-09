<?php

namespace App\Http\Livewire\Reward\Daily;

use App\Models\Daily;
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
        Daily::findOrFail($this->key)->delete();
        $this->batal();
    }

    public function restore(){
        Daily::withTrashed()->findOrFail($this->key)->restore();
        $this->batal();
    }

    public function render()
    {
        $data = Daily::where('daily_date', 'like', '%'.$this->cari.'%');

        if ($this->deleted == 1){
            $data = $data->onlyTrashed();
        }

        $data = $data->orderBy('daily_date', 'desc')->paginate(10);
        $this->emit('reinitialize');
        return view('livewire.reward.daily.index', [
            'data' => $data,
            'no' => ($this->page - 1) * 10
        ])
        ->extends('livewire.main', [
            'breadcrumb' => ['Reward', 'Daily'],
            'title' => 'Daily Reward'
        ])
        ->section('subcontent');
    }
}
