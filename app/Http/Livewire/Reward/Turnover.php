<?php

namespace App\Http\Livewire\Reward;

use App\Models\Rate;
use App\Models\Member;
use Livewire\Component;
use App\Models\Achievement;
use App\Models\Transaction;
use Livewire\WithPagination;
use App\Models\TransactionReward;
use Illuminate\Support\Facades\DB;

class Turnover extends Component
{
    use WithPagination;

    public $key, $error, $notification,
            $deleted, $lbc_price, $rate, $search;

    protected $queryString = ['search', 'deleted',],
            $paginationTheme = 'bootstrap';

    public function batal(){
        $this->reset('key');
    }

    public function setKey($key){
        $this->key = $key;
    }

    public function mount()
    {
        $this->rate = new Rate();
    }

    public function process()
    {
        try {
                $achievement = Achievement::findOrFail($this->key);
                $achievement->process = 'Accomplished';
                $achievement->save();

            $this->reset('key');
            return $this->notification = [
                'tipe' => 'success',
                'pesan' => "Achievement have been processed"
            ];
        } catch(\Exception $e){
            return $this->notification = [
                'tipe' => 'danger',
                'pesan' => $e->getMessage()
            ];
        }
    }

    // public function process(){
    //     try {
    //         DB::transaction(function () {
    //             $id = bitcoind()->getaccountaddress("administrator").date('Ymdhis').round(microtime(true) * 1000);

    //             $achievement = Achievement::findOrFail($this->key);

    //             $lbc_price = $this->rate->last_dollar;
    //             $lbc_amount = $achievement->rating->rating_reward / $lbc_price;

    //             $achievement->process = $lbc_amount;
    //             $achievement->transaction_id = $id;
    //             $achievement->save();

    //             bitcoind()->move("administrator", $achievement->member->username, round($lbc_amount, 8), 1, 'Achievement '.$achievement->rating->rating_order);
    //         });

    //         $this->reset('key');
    //         return $this->notification = [
    //             'tipe' => 'success',
    //             'pesan' => "Achievement have been processed"
    //         ];
    //     } catch(\Exception $e){
    //         return $this->notification = [
    //             'tipe' => 'danger',
    //             'pesan' => $e->getMessage()
    //         ];
    //     }
    // }

    public function render()
    {
        $data = Achievement::with('rating')->whereHas('member', fn ($q) => $q->where('member_user', 'like', '%'.$this->search.'%')->orWhere('username', 'like', '%'.$this->search.'%'));

        if ($this->deleted == 1){
            $data = $data->where('process', '!=', 'Accomplished');
        }else if ($this->deleted == 2){
            $data = $data->where('process', 'Accomplished');
        }else{
            $data = $data->whereNull('process');
        }

        $data = $data->paginate(10);
        $this->emit('reinitialize');
        return view('livewire.reward.turnover',[
            'data' => $data,
            'no' => ($this->page - 1) * 10
        ])
        ->extends('livewire.main', [
            'breadcrumb' => ['Reward', 'Achievement'],
            'title' => 'Achievement'
        ])
        ->section('subcontent');
    }
}
