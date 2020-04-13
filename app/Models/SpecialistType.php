<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialistType extends Model
{


    public function specialist()
    {
        return $this->belongsToMany('App\Models\Doctor', 'doctor_specialists', 'specialist_id', 'doctor_id');
    }

}
