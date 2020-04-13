<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Booking extends Model
{


    public function storeRules()
    {
        return [
            'patient_name' => 'required',
            'mobile_no' => 'required|numeric',
            'organization_id' => 'required|numeric',
            'chamber_id' => 'required|numeric',
            'doctor_id' => 'required|numeric',
            'serial_no' => 'required|numeric',
            'visited_time' => 'required',
        ];
    }


}
