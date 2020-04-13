<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Doctor extends Model
{
    //
    public function storeRules()
    {
        return [
            'name' => 'required',
            'degree' =>'required',
            'doc_bmdc_no' =>'required',
            'address' =>'required',
            'phone' =>'required',
            'email' =>'required|unique:users,email',
            'district_id' => 'required|numeric',
            'division_id' => 'required|numeric',
            'thana_id' => 'required|numeric',
            'organization_id' => 'required',
        ];
    }

    public function editRules()
    {
        return [
            'name' => 'required',
            'degree' =>'required',
            'doc_bmdc_no' =>'required',
            'address' =>'required',
            'phone' =>'required',
            'gender' =>'required',
            'district_id' => 'required|numeric',
            'division_id' => 'required|numeric',
            'thana_id' => 'required|numeric',
            'organization_id' => 'required',
        ];
    }

    public function scopeSearch($query, $field, $search)
    {
        return $query->where($field, 'LIKE', "%$search%")->latest();
    }



    public function chambers()
    {
        return $this->belongsToMany('App\Models\Chamber', 'doctor_chambers', 'doctor_id', 'chamber_id');
    }

    public function specialist()
    {
        return $this->belongsToMany('App\Models\Specialist', 'doctor_specialists', 'doctor_id', 'specialist_id');
    }


    public static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->created_by = Auth::check() ? Auth::user()->id : 0;
        });

    }
}
