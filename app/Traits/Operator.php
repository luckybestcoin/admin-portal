<?php

namespace App\Traits;

trait Operator{
    public static function bootOperator(){
        if(auth()->check()){
            static::creating(function ($model){
                $model->user_id = auth()->id();
            });
        }
    }
}
