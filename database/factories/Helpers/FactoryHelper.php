<?php

namespace Database\Factories\Helpers;

class FactoryHelper
{

    // This function will get random model id from Database
    // string | HasFactory $model

    public static function getRandModelId(string $model){
        // get model count
        $count = $model::query()->count();

        if($count ===0 ){
            //if model count is 0
            //we should create a new record and retrieve the record id

            return $model::factory()->create()->id;
        }else{
            //generate random number between 1 and model count
            return rand(1, $count);

        }

    }
}
