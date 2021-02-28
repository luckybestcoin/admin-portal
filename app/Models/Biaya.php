<?php

namespace App\Models;

use App\Traits\Operator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Biaya extends Model
{
    use HasFactory, Operator;

    protected $table = 'biaya';
    protected $primaryKey = 'biaya_id';
}
