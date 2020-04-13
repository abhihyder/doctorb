<?php

namespace App\Libraries;


use Illuminate\Support\Facades\Auth;


class ACL
{


    public static function getAccsessRight($module, $right = '', $id = null)
    {
        $accessRight = '';
        if (Auth::user() && Auth::user()->is_approved == 1) {
            $user_type = Auth::user()->user_type;
        } else {
            die('You are not authorized user or your session has been expired! error 9999');
        }
        $user = explode("x", $user_type);
        switch ($module) {

            case 'doctor':
                if ($user_type == '3x303') {
                    $accessRight = 'AVE';
                }
                break;
            default:
                $accessRight = '';
        }
        if ($right != '') {
            if (strpos($accessRight, $right) === false) {
                return false;
            } else {
                return true;
            }
        } else {
            return $accessRight;
        }
    }


}
