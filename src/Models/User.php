<?php
namespace App\models;

class User extends BaseModel
{

    public function registration()
    {
        return $this->hasOne('App\Models\Registration');
    }
}
