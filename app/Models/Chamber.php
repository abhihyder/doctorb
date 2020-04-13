<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chamber extends Model
{

    // My code-----------
    protected $fillable = [
        'organization_id',
        'chamber_name',
        'chamber_address',
        'division_id',
        'district_id',
        'thana_id',
        'room_no',
        'phone',
        'status',
    ];
    //
    // public function storeRules()
    // {
    //     return [
    //         'chamber_name' => 'required',
    //         'chamber_address' => 'required',
    //         'phone' =>'required',
    //         'room_no' =>'required',
    //         'district_id' => 'required|numeric',
    //         'division_id' => 'required|numeric',
    //         'thana_id' => 'required|numeric',
    //         'organization_id' => 'required|numeric',
    //     ];
    // }

    // public function editRules()
    // {

    //     return [
    //         'chamber_name' => 'required',
    //         'chamber_address' => 'required',
    //         'phone' =>'required',
    //         'room_no' =>'required',
    //         'district_id' => 'required|numeric',
    //         'division_id' => 'required|numeric',
    //         'thana_id' => 'required|numeric',
    //         'organization_id' => 'required|numeric',
    //     ];
    // }

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


    public function organization(){

        return $this->belongsTo('App\Models\Organization', 'organization_id');
    }


    public function doctor()
    {
        return $this->belongsToMany('App\Models\Doctor', 'doctor_chambers', 'chamber_id', 'doctor_id');
    }
}
