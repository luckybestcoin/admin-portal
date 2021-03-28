<?php

namespace App\Http\Livewire\Setup\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class Form extends Component
{
    public $data;
    public $name;
    public $username;
    public $level;
    public $back;
    public $password;
    public $menu = [];
    public $access = [];
    public $key;
    public $data_level = [];
    public $data_pegawai = [];
    public $data_menu = [];

    protected $rules = [
        'username' => 'required',
        'name' => 'required',
        'access' => 'required',
    ];
    public function mount($id = null)
    {
        $this->back = Str::contains(url()->previous(), ['add', 'edit'])? '/setup/user': url()->previous();
        $this->menu = collect($this->menu(config('sidebar.menu')))->flatten();
        $this->data_menu = collect($this->menu(config('sidebar.menu'), true))->where('id', '!=', 'dashboard');
        $this->key = $id;
        if ($this->key) {
            $this->data = User::findOrFail($this->key);
            $this->username = $this->data->user_nick;
            $this->name = $this->data->user_name;
            $this->access = $this->data->getPermissionNames()->toArray();
        }
    }

    public function submit()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                if ($this->key) {
                    if ($this->password) {
                        $this->data->user_password = Hash::make($this->password);
                    }
                    $this->data->user_name = $this->name;
                    $this->data->save();
                    $this->data->syncPermissions();
                    $this->data->removeRole($this->data->getRoleNames()[0]);
                    $this->data->assignRole('user');

                    $this->data->givePermissionTo('dashboard');

                    foreach ($this->access as $i => $mn) {
                        $this->data->givePermissionTo($mn);
                    }
                } else {
                    $data = new User();
                    $data->user_name = $this->name;
                    $data->user_nick = $this->username;
                    $data->user_password = Hash::make($this->password);
                    $data->save();
                    $data->assignRole('user');

                    $data->givePermissionTo('dashboard');
                    foreach ($this->access as $i => $mn) {
                        $data->givePermissionTo($mn);
                    }
                }
            });

            return redirect()->to(filter_var($this->back, FILTER_VALIDATE_URL));

        } catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    protected $listeners = [
        'set:tambahhakaccess' => 'tambahHakaccess',
        'set:hapushakaccess' => 'hapusHakaccess'
    ];

    public function tambahHakaccess($menu)
    {
        $this->access[] = $menu;
    }

    public function hapusHakaccess($menu)
    {
        if (($key = array_search($menu, $this->access)) !== false) {
            unset($this->access[$key]);
        }
    }

    public function cancel()
    {
        return redirect()->to($this->back);
    }

    public function setLevel()
    {
        if ($this->level == 'super-admin') {
            $this->access = $this->menu;
        }else{
            $this->access = [];
        }
    }

    function menu($val, $flatten = false)
    {
        $menu = [];
        foreach ($val as $key => $row) {
            if ($flatten) {
                $menu[] = [
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'sub_menu' => !empty($row['sub_menu'])? $this->menu($row['sub_menu'], true): []
                ];
            } else {
                $menu[] = [
                    'id' => $row['id'],
                    'sub_menu' => !empty($row['sub_menu'])? $this->menu($row['sub_menu']): []
                ];
            }
        }
        return $menu;
    }

    public function render()
    {
        return view('livewire.setup.user.form')
        ->extends('livewire.main', [
            'breadcrumb' => ['Setup', 'User', ($this->key? 'Edit': 'Add')],
            'title' => ($this->key? 'Edit': 'Add').' User'
        ])
        ->section('subcontent');
    }
}
