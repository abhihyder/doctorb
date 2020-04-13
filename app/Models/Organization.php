<?php

namespace App\Models;

use App\RipositoryInterface\OrganizationRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Organization extends Model
{
    //
    public function storeRules()
    {
        return [
            'organization_name' => 'required',
            'organization_address' => 'required',
            // 'organization_admin_name' => 'required',
            'email' =>'required|unique:users,email',
            'phone' =>'required',
            'district_id' => 'required|numeric',
            'division_id' => 'required|numeric',
            'thana_id' => 'required|numeric',
        ];
    }

    public function editRules()
    {
        return [
            'organization_name' => 'required',
            'organization_address' => 'required',
            'phone' =>'required',
            'district_id' => 'required|numeric',
            'division_id' => 'required|numeric',
            'thana_id' => 'required|numeric',
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
