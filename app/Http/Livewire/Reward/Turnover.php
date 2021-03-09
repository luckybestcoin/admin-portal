<?php

namespace App\Http\Livewire\Reward;

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

    public $key, $cari, $error, $notification,
            $deleted;

    protected $queryString = ['cari', 'deleted'],
            $paginationTheme = 'bootstrap';

    public function batal(){
        $this->reset('key');
    }

    public function setKey($key){
        $this->key = $key;
    }

    public function process(){
        try {
            DB::transaction(function () {
                $id = bitcoind()->getaccountaddress("administrator").date('Ymdhis').round(microtime(true) * 1000);

                $achievement = Achievement::findOrFail($this->key);
                $achievement->process = auth()->user()->user_nick;
                $achievement->transaction_id = $id;
                $achievement->save();

                $trx = new Transaction();
                $trx->transaction_id = $id;
                $trx->transaction_information = "Achievement for min. turnover ".$achievement->rating->rating_min_turnover.", Reward ".$achievement->rating->rating_reward;
                $trx->save();

                $reward = new TransactionReward();
                $reward->transaction_id = $id;
                $reward->transaction_reward_information = "Achievement for min. turnover ".$achievement->rating->rating_min_turnover.", Reward ".$achievement->rating->rating_reward;
                $reward->transaction_reward_type = "Achievement";
                $reward->transaction_reward_amount = $achievement->rating->rating_reward;
                $reward->member_id = auth()->id();
                $reward->save();
            });

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

    public function render()
    {
        $data = Achievement::with('member')->with('rating');

        if ($this->deleted == 1){
            $data = $data->whereNotNull('process');
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
