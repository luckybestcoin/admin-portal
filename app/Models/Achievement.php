<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Achievement extends Model
{
    use HasFactory;

    protected $table = 'achievement';
    protected $primaryKey = 'achievement_id';

    public function rating()
    {
        return $this->belongsTo('App\Models\Rating', 'rating_id');
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'member_id');
    }
}
