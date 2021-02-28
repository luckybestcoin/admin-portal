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
        return $this->hasOne(Referral::class, 'member_id')->withTrashed();
    }
}
