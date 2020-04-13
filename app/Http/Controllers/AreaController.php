<?php

namespace App\Http\Controllers;
use App\Models\AreaInfo;
use Illuminate\Http\Request;
class AreaController extends Controller
{

    public function getDistrict(Request $request){
        $dId = $request['divId'];
        $districts = AreaInfo::district($dId)->get();
        $htmlContent = '';
        $htmlContent = "<option value=''>Select One</option>";
        foreach ($districts as $district) {
            $htmlContent .= "<option value='$district->id'>$district->name</option>";
        }

        echo $htmlContent;
        return;
    }

    public function getThana(Request $request){
        $dId = $request['disId'];
        $thanas = AreaInfo::thana($dId)->get();

        $htmlContent = '';
        $htmlContent = "<option value=''>Select One</option>";
        foreach ($thanas as $thana) {
            $htmlContent .= "<option value='$thana->id'>$thana->name</option>";
        }

        echo $htmlContent;
        return;

    }
}
