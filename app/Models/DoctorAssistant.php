<?php

namespace App\Models;

use App\RipositoryInterface\DoctorAssistantRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DoctorAssistant extends Model
{


    public function storeRules()
    {
        return [
            'name'=>'required',
            'type'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'user_id'=>'required',
            'organization_id'=>'required',
            'doctor_id'=>'required',
        ];
    }


    public function editRules()
    {
        return [
            'name'=>'required',
            'type'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'user_id'=>'required',
            'organization_id'=>'required',
            'doctor_id'=>'required',
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
