<?php

namespace App\Models;

use App\Traits\Operator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paket extends Model
{
    use HasFactory, Operator, SoftDeletes;

    protected $table = 'paket';
    protected $primaryKey = 'paket_id';

    public function setPaketHargaAttribute($value){
        $this->attributes['paket_harga'] = str_replace(",", "", $value);
    }
}
