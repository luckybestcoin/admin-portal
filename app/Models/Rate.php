<?php

namespace App\Models;

use App\Traits\Operator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rate extends Model
{
    use HasFactory, Operator;

    protected $table = 'rate';
    protected $primaryKey = 'rate_id';

    public function getLastDollarAttribute()
    {
        return $this->where('rate_currency', 'USD')->orderBy('created_at', 'desc')->get()->first()->rate_price;
    }
}
