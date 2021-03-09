<?php

namespace App\Models;

use App\Traits\Operator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionDeposit extends Model
{
    use HasFactory, Operator;

    protected $table = 'transaction_deposit';
    protected $primaryKey = 'transaction_deposit_id';

    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction', 'transaction_id');
    }
}
