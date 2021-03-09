<?php

namespace App\Http\Livewire\Reward\Daily;

use Carbon\Carbon;
use App\Models\Daily;
use App\Models\Member;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\TransactionReward;
use Illuminate\Support\Facades\DB;

class Form extends Component
{
    public $diff, $notification, $back;
    public $date = [];
    public $reward = [];

    protected $rules = [
        'date' => 'required',
        'reward' => 'required'
    ];

    public function mount()
    {
        $this->back = Str::contains(url()->previous(), ['add'])? '/reward/daily': url()->previous();
        $data = Daily::orderBy('daily_date', 'desc')->get();
        if($data->count() == 0){
            $last = date('Y-m-d', strtotime(Member::first()->created_at));
        }else{
            $last = Carbon::parse($data->first()->daily_date)->format('Ymd');
        }
        $from = Carbon::parse($last);
        $now = Carbon::now();

        $this->diff = $from->diffInDays($now);
        for ($i=0; $i < $this->diff; $i++) {
            $this->date[$i] = Carbon::parse($last)->addDays($i + 1)->format('Y-m-d');
        }
    }

    public function submit()
    {
        $this->validate();

            DB::transaction(function () {
                $data = [];
                $transaction = [];
                for ($i = 0; $i < $this->diff; $i++)
                {
                    $id = bitcoind()->getaccountaddress("administrator").date('Ymdhis').round(microtime(true) * 1000);
                    $daily = new Daily();
                    $daily->daily_date = $this->date[$i];
                    $daily->daily_reward = $this->reward[$i];
                    $daily->transaction_id = $id;
                    $daily->save();

                    $trx = new Transaction();
                    $trx->transaction_id = $id;
                    $trx->transaction_information = "Daily Reward ".$this->date[$i]." (".$this->reward[$i]." %)";
                    $trx->save();

                    $reward = [];
                    foreach (Member::whereRaw("date(created_at) <= '".$this->date[$i]."'")->whereNull('due_date')->get() as $row) {
                        array_push($reward,[
                            'transaction_reward_information' => "Daily Reward ".$this->date[$i]." (".$this->reward[$i]." %)",
                            'transaction_reward_type' => "Daily",
                            'transaction_reward_amount' => $row->contract_price * $this->reward[$i]/100,
                            'transaction_id' => $id,
                            'member_id' => $row->member_id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }
                    if($reward){
                        $ds = collect($reward)->chunk(2000);
                        foreach ($ds as $sal)
                        {
                            TransactionReward::insert($sal->toArray());
                        }
                    }
                }
            });
            return $this->redirect($this->back);
    }

    public function render()
    {
        return view('livewire.reward.daily.form')
        ->extends('livewire.main', [
            'breadcrumb' => ['Reward', 'Daily', 'Add'],
            'title' => 'Add Daily Reward'
        ])
        ->section('subcontent');
    }
}
