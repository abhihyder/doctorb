<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Patient extends Model
{


    public function storeRules()
    {
        return [
            'booking_serial_code'=>'required',
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'serial_no'=>'required',
            'patient_type'=>'required',
            'user_id'=>'required',
            'organization_id'=>'required',
            'doctor_id'=>'required',
            'chamber_id'=>'required',
            'agent_id'=>'required',
        ];
    }


    public function editRules()
    {
        return [
            'booking_serial_code'=>'required',
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'serial_no'=>'required',
            'patient_type'=>'required',
            'user_id'=>'required',
            'organization_id'=>'required',
            'doctor_id'=>'required',
            'chamber_id'=>'required',
            'agent_id'=>'required',
        ];
    }


    public function scopeSearch($query, $field, $search)
    {
        return $query->where($field, 'LIKE', "%$search%")->latest();
    }


    public static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->created_by = Auth::check() ? Auth::user()->id : 0;
        });

    }
}
