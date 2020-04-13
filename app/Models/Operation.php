<?php

namespace App\Models;

use App\RipositoryInterface\OperationRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Operation extends Model
{


    public function storeRules()
    {
        return [
            'operation_title' => 'required',
            'organization' => 'required|numeric',
            'patient_id' => 'required',
        ];
    }


    public function editRules()
    {
        return [
            'operation_title' => 'required',
            'organization' => 'required|numeric',
            'patient_id' => 'required',
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
