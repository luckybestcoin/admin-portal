<?php

namespace App\Models;

use App\Traits\Operator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HariLibur extends Model
{
    use HasFactory, Operator;

    protected $table = 'hari_libur';
    protected $primaryKey = 'hari_libur_id';
}
