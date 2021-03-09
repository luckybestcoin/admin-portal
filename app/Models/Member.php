<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'member';
    protected $primaryKey = 'member_id';

    public function referral()
    {
        return $this->hasOne('App\Models\Referral', 'member_id')->withTrashed();
    }

    public function achievement()
    {
        return $this->hasMany('App\Models\Achievement', 'rating_id', 'rating_id');
    }
}
