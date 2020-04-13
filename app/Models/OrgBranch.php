<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrgBranch extends Model
{


    public function storeRules()
    {
        return [
            'name' => 'required',
            'organization_address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'image' => 'required',
            'status' => 'required',
            'organization_id' => 'required',
            'created_by' => 'required',
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->created_by = Auth::check() ? Auth::user()->id : 0;
        });

    }


    public function editRules()
    {
        return [
            'name' => 'required',
            'organization_address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'image' => 'required',
            'status' => 'required',
            'organization_id' => 'required',
            'created_by' => 'required',
        ];
    }


    public function scopeSearch($query, $field, $search)
    {
        return $query->where($field, 'LIKE', "%$search%")->latest();
    }
}
