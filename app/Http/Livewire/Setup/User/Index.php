<?php

namespace App\Http\Livewire\Setup\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $type = 0;
    public $search;
    public $key;
    public $deleted = 0;

    protected $queryString = ['search', 'deleted'];

    public function cancel()
    {
        $this->key = null;
    }

    public function key($id)
    {
        $this->key = $id;
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function delete()
	{
        User::findOrFail($this->key)->delete();
        $this->key = null;
	}

	public function restore()
	{
        User::withTrashed()->findOrFail($this->key)->restore();
        $this->key = null;
    }

    public function render()
    {
        $data = User::where('user_nick', 'like', '%'.$this->search.'%');

        switch ($this->deleted) {
            case '1':
                $data = $data->onlyTrashed();
                break;
        }

        $data = $data->orderBy('user_nick')->paginate(10);
        $this->emit('reinitialize');
        return view('livewire.setup.user.index',[
            'no' => ($this->page - 1) * 10,
            'data' => $data
        ])
        ->extends('livewire.main', [
            'breadcrumb' => ['Setup', 'User'],
            'title' => 'User'
        ])
        ->section('subcontent');
    }
}
