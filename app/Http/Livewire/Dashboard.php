<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Rate;
use App\Models\Daily;
use Livewire\Component;

class Dashboard extends Component
{
    public $notification = [];

    public function mount()
    {
        $this->daily();
        $this->rate();
    }

    private function daily()
    {
        $data = Daily::orderBy('daily_date', 'desc')->get();
        if($data->count() == 0){
            $last = date('Y-m-d', strtotime(Member::first()->created_at));
        }else{
            $last = Carbon::parse($data->first()->daily_date)->format('Y-m-d');
        }
        $from = Carbon::parse($last);
        $now = Carbon::now();

        $diff = $from->diffInDays($now);
        if ($diff > 0) {
            array_push($this->notification, "Daily rewards on the date from ".Carbon::parse($last)->format('Y-m-d')." until ".Carbon::parse($last)->addDays($diff)->format('Y-m-d')." not yet given. <a href='/reward/daily/add'>Click here to process</a>");
        }
    }

    private function rate()
    {
        $data = Rate::orderBy('created_at', 'desc')->get();
        $last = Carbon::parse($data->first()->created_at);
        $now = Carbon::now();
        $diff = $last->diffInDays($now);
        if ($diff > 0) {
            array_push($this->notification, "Rate LBC on the date from ".Carbon::parse($last)->format('Y-m-d')." until ".Carbon::parse($last)->addDays($diff)->format('Y-m-d')." not yet given. <a href='/setup/rate/add'>Click here to process</a>");
        }
    }

    public function render()
    {
        return view('livewire.dashboard')
        ->extends('livewire.main', [
            'breadcrumb' => [],
            'title' => 'Dashboard',
            'description' => 'Main Page'
        ])
        ->section('subcontent');
    }
}
