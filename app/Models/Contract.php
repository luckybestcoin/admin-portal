<?php

namespace App\Models;

use App\Traits\Operator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory, Operator, SoftDeletes;

    protected $table = 'contract';
    protected $primaryKey = 'contract_id';

    public function setContractPriceAttribute($value){
        $this->attributes['contract_price'] = str_replace(",", "", $value);
    }
}
