<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Agent extends Model
{


    public function storeRules()
    {
        return [
            'name' => 'required',
            'phone' => 'required|numeric',
            'organization_id' => 'required|numeric',
            'chamber_id' => 'required|numeric',
        ];
    }


    public function editRules()
    {
        return [
            'name' => 'required',
            'phone' => 'required|numeric',
            'organization_id' => 'required|numeric',
            'chamber_id' => 'required|numeric',
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
