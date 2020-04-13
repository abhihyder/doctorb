<?php

namespace App\Libraries;


use App\Modules\Settings\Models\Configuration;
use App\User;
use Illuminate\Support\Facades\Auth;


class CommonFunction
{

    public static function getUserId()
    {

        if (Auth::user()) {
            return Auth::user()->id;
        } else {
            return 0;
        }
    }



    public static function convert2Bangla($eng_number)
    {
        $eng = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $ban = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        return str_replace($eng, $ban, $eng_number);
    }

    public static function convert2English($ban_number)
    {
        $eng = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $ban = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        return str_replace($ban, $eng, $ban_number);
    }

    public static function generateTrackingID($prefix, $id)
    {
        $prefix = strtoupper($prefix);
        $str = $id . date('Y') . mt_rand(0, 9);
        if ($prefix == 'M' || $prefix == 'N') {
            if (strlen($str) > 12) {
                $str = substr($str, strlen($str) - 12);
            }
        } elseif ($prefix == 'G') {
            if (strlen($str) > 11) {
                $str = substr($str, strlen($str) - 11);
            }
        } elseif ($prefix == 'T') {
            if (strlen($str) > 12) {
                $str = substr($str, strlen($str) - 12);
            }
        } elseif ($prefix == 'D') {
            if (strlen($str) > 12) {
                $str = substr($str, strlen($str) - 12);
            }
        } else {
            if (strlen($str) > 14) {
                $str = substr($str, strlen($str) - 14);
            }
        }
        return strtoupper($prefix . dechex($str));
    }



    public static function getImageConfig($type)
    {
        extract(CommonFunction::getImageDocConfig());
        $config = Configuration::where('caption', $type)->pluck('details');
//        $reportHelper = new ReportHelper();
//        [File Format: *.jpg / *.png Dimension: {$height}x{$width}px File size($filesize)KB]
        if ($type == 'IMAGE_SIZE') {
            $data['width'] = ($IMAGE_WIDTH - ($IMAGE_WIDTH * $IMAGE_DIMENSION_PERCENT) / 100) . '-' . ($IMAGE_WIDTH + ($IMAGE_WIDTH * $IMAGE_DIMENSION_PERCENT) / 100);
            $data['height'] = ($IMAGE_HEIGHT - ($IMAGE_HEIGHT * $IMAGE_DIMENSION_PERCENT) / 100) . '-' . ($IMAGE_HEIGHT + ($IMAGE_HEIGHT * $IMAGE_DIMENSION_PERCENT) / 100);
            $data['variation'] = $IMAGE_DIMENSION_PERCENT;
            $data['filesize'] = $IMAGE_SIZE;
        } elseif ($type == 'DOC_IMAGE_SIZE') {
            $data['width'] = ($DOC_WIDTH - ($DOC_WIDTH * $IMAGE_DIMENSION_PERCENT) / 100) . '-' . ($DOC_WIDTH + ($DOC_WIDTH * $IMAGE_DIMENSION_PERCENT) / 100);
            $data['height'] = ($DOC_HEIGHT - ($DOC_HEIGHT * $IMAGE_DIMENSION_PERCENT) / 100) . '-' . ($DOC_HEIGHT + ($DOC_HEIGHT * $IMAGE_DIMENSION_PERCENT) / 100);
            $data['variation'] = $DOC_DIMENSION_PERCENT;
            $data['filesize'] = $DOC_SIZE;
        } elseif ($type == 'SIGNATURE_SIZE') {
            $data['width'] = ($SIGN_WIDTH - ($SIGN_WIDTH * $SIGN_DIMENSION_PERCENT) / 100) . '-' . ($SIGN_WIDTH + ($SIGN_WIDTH * $SIGN_DIMENSION_PERCENT) / 100);
            $data['height'] = ($SIGN_HEIGHT - ($SIGN_HEIGHT * $SIGN_DIMENSION_PERCENT) / 100) . '-' . ($SIGN_HEIGHT + ($SIGN_HEIGHT * $SIGN_DIMENSION_PERCENT) / 100);
            $data['variation'] = $SIGN_DIMENSION_PERCENT;
            $data['filesize'] = $SIGN_SIZE;
        }
        $string = self::ConvParaEx($config, $data);
        return $string;
    }



    public static function getImageDocConfig()
    {
        $config = array();
        $config['IMAGE_DIMENSION'] = Configuration::where('caption', 'IMAGE_SIZE')->pluck('value');
        $config['IMAGE_SIZE'] = Configuration::where('caption', 'IMAGE_SIZE')->pluck('value2');

        // Image size
        $split_img_size = explode('-', $config['IMAGE_SIZE']);
        $config['IMAGE_MIN_SIZE'] = $split_img_size[0];
        $config['IMAGE_MAX_SIZE'] = $split_img_size[1];

        // image dimension
        $split_img_dimension = explode('x', $config['IMAGE_DIMENSION']);
        $split_img_variation = explode('~', $split_img_dimension[1]);
        $config['IMAGE_WIDTH'] = $split_img_dimension[0];
        $config['IMAGE_HEIGHT'] = $split_img_variation[0];
        $config['IMAGE_DIMENSION_PERCENT'] = $split_img_variation[1];

        //image max/min width and height
        $config['IMAGE_MIN_WIDTH'] = $split_img_dimension[0] - (($split_img_dimension[0] * $split_img_variation[1]) / 100);
        $config['IMAGE_MAX_WIDTH'] = $split_img_dimension[0] + (($split_img_dimension[0] * $split_img_variation[1]) / 100);

        $config['IMAGE_MIN_HEIGHT'] = $split_img_variation[0] - (($split_img_variation[0] * $split_img_variation[1]) / 100);
        $config['IMAGE_MAX_HEIGHT'] = $split_img_variation[0] + (($split_img_variation[0] * $split_img_variation[1]) / 100);

        //========================= image config end =====================
        // for doc file
        $config['DOC_DIMENSION'] = Configuration::where('caption', 'DOC_IMAGE_SIZE')->pluck('value');
        $config['DOC_SIZE'] = Configuration::where('caption', 'DOC_IMAGE_SIZE')->pluck('value2');

        // Doc size
        $split_doc_size = explode('-', $config['DOC_SIZE']);
        $config['DOC_MIN_SIZE'] = $split_doc_size[0];
        $config['DOC_MAX_SIZE'] = $split_doc_size[1];

        // doc dimension
        $split_doc_dimension = explode('x', $config['DOC_DIMENSION']);
        $split_doc_variation = explode('~', $split_doc_dimension[1]);
        $config['DOC_WIDTH'] = $split_doc_dimension[0];
        $config['DOC_HEIGHT'] = $split_doc_variation[0];
        $config['DOC_DIMENSION_PERCENT'] = $split_doc_variation[1];

        //doc max/min width and height
        $config['DOC_MIN_WIDTH'] = $split_doc_dimension[0] - (($split_doc_dimension[0] * $split_doc_variation[1]) / 100);
        $config['DOC_MAX_WIDTH'] = $split_doc_dimension[0] + (($split_doc_dimension[0] * $split_doc_variation[1]) / 100);

        $config['DOC_MIN_HEIGHT'] = $split_doc_variation[0] - (($split_doc_variation[0] * $split_doc_variation[1]) / 100);
        $config['DOC_MAX_HEIGHT'] = $split_doc_variation[0] + (($split_doc_variation[0] * $split_doc_variation[1]) / 100);


        //====================FOR SIGNATURE ========================

        $config['SIGN_DIMENSION'] = Configuration::where('caption', 'SIGNATURE_SIZE')->pluck('value');
        $config['SIGN_SIZE'] = Configuration::where('caption', 'SIGNATURE_SIZE')->pluck('value2');

        // Doc size
        $split_doc_size = explode('-', $config['SIGN_SIZE']);
        $config['SIGN_MIN_SIZE'] = $split_doc_size[0];
        $config['SIGN_MAX_SIZE'] = $split_doc_size[1];

        // doc dimension
        $split_doc_dimension = explode('x', $config['SIGN_DIMENSION']);
        $split_doc_variation = explode('~', $split_doc_dimension[1]);
        $config['SIGN_WIDTH'] = $split_doc_dimension[0];
        $config['SIGN_HEIGHT'] = $split_doc_variation[0];
        $config['SIGN_DIMENSION_PERCENT'] = $split_doc_variation[1];

        //doc max/min width and height
        $config['SIGN_MIN_WIDTH'] = $split_doc_dimension[0] - (($split_doc_dimension[0] * $split_doc_variation[1]) / 100);
        $config['SIGN_MAX_WIDTH'] = $split_doc_dimension[0] + (($split_doc_dimension[0] * $split_doc_variation[1]) / 100);

        $config['SIGN_MIN_HEIGHT'] = $split_doc_variation[0] - (($split_doc_variation[0] * $split_doc_variation[1]) / 100);
        $config['SIGN_MAX_HEIGHT'] = $split_doc_variation[0] + (($split_doc_variation[0] * $split_doc_variation[1]) / 100);

        return $config;
    }

    static function getName4SMS($name)
    {
        if (strlen($name) > 15) {
            $names = explode(' ', $name);
            if (count($names) > 2) {
                $name = $names[0] . ' ' . $names[1];
            }
        }
        if (strlen($name) > 15) {
            $name = substr($name, 0, 14) . '.';
        }
        return $name;
    }



//   ConvParaEx function imported from Report Helper Libraries
    public static function ConvParaEx($sql, $data, $sm = '{$', $em = '}', $optional = false)
    {
        $sql = ' ' . $sql;
        $start = strpos($sql, $sm);
        $i = 0;
        while ($start > 0) {
            if ($i++ > 20) {
                return $sql;
            }
            $end = strpos($sql, $em, $start);
            if ($end > $start) {
                $filed = substr($sql, $start + 2, $end - $start - 2);
                if (strtolower(substr($filed, 0, 8)) == 'optional') {
                    $optionalCond = self::ConvParaEx(substr($filed, 9), $data, '[$', ']', true);
                    $sql = substr($sql, 0, $start) . $optionalCond . substr($sql, $end + 1);
                } else {
                    $inputData = self::getData($filed, $data, substr($sql, 0, $start));
                    if ($optional && (($inputData == '') || ($inputData == "''"))) {
                        $sql = '';
                        break;
                    } else {
                        $sql = substr($sql, 0, $start) . $inputData . substr($sql, $end + 1);
                    }
                }
            }
            $start = strpos($sql, $sm);
        }
        return trim($sql);
    }

	public static function getData($filed, $data, $prefix = null)
	{
		$filedKey = explode('|', $filed);
		$val = trim($data[$filedKey[0]]);
		if (!is_numeric($val)) {
			if ($prefix) {
				$prefix = strtoupper(trim($prefix));
				if (substr($prefix, strlen($prefix) - 3) == 'IN(') {
					$vals = explode(',', $val);
					$val = '';
					for ($i = 0; $i < count($vals); $i++) {
						if (is_numeric($vals[$i])) {
							$val .= (strlen($val) > 0 ? ',' : '') . $vals[$i];
						} else {
							$val .= (strlen($val) > 0 ? ',' : '') . "'" . $vals[$i] . "'";
						}
					}
				} elseif (!(substr($prefix, strlen($prefix) - 1) == "'" || substr($prefix, strlen($prefix) - 1) == "%")) {
					$val = "'" . $val . "'";
				}
			}
		}
		if ($val == '') $val = "''";
		return $val;
	}



    /*     * ****************************End of Class***************************** */
}
