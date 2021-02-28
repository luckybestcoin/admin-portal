<?php

namespace App\Models;

use App\Traits\Operator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kurs extends Model
{
    use HasFactory, Operator;

    protected $table = 'kurs';
    protected $primaryKey = 'kurs_id';

    public function setKursJualAttribute($value){
        $this->attributes['kurs_jual'] = str_replace(",", "", $value);
    }

    public function setKursBeliAttribute($value){
        $this->attributes['kurs_beli'] = str_replace(",", "", $value);
    }
}
