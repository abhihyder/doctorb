<?php

namespace App\Services;


use Illuminate\Support\Facades\Crypt;

class AppService
{

    public function encryptString($data){

        return Crypt::encryptString($data);
    }

    public function decryptString($data){

        return Crypt::decryptString($data);
    }

}
