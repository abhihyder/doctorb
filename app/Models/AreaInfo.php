<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaInfo extends Model
{
    protected $table = "area_info";


    private $divisionType = 1;

    private $districtType = 2;

    private $thanaType = 3;


    public function scopeDivision($query)
    {
        return $query->where('area_type', $this->divisionType);
    }


    public function scopeDistrict($query, $division)
    {
        return $query->where('area_type', $this->districtType)->where('parent_id', $division);
    }


    public function scopeThana($query, $district)
    {
        return $query->where('area_type', $this->thanaType)->where('parent_id', $district);
    }

    public function scopeAllDistricts($query)
    {
        return $query->where('area_type', $this->districtType);
    }


    public function scopeAllThanas($query)
    {
        return $query->where('area_type', $this->thanaType);
    }
}
