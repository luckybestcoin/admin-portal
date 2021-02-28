<?php

namespace App\Models;

use App\Traits\Operator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peringkat extends Model
{
    use HasFactory, Operator, SoftDeletes;

    protected $table = 'peringkat';
    protected $primaryKey = 'peringkat_id';

    public function setPeringkatOmsetMinAttribute($value){
        $this->attributes['peringkat_omset_min'] = str_replace(",", "", $value);
    }

    public function setPeringkatBonusAttribute($value){
        $this->attributes['peringkat_bonus'] = str_replace(",", "", $value);
    }
}
