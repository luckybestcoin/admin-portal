<?php

namespace App\Traits;

trait Operator{
    public static function bootOperator(){
        if(auth()->check()){
            static::creating(function ($model){
                $model->pengguna_id = auth()->id();
            });
        }
    }
}
