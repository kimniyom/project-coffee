<?php

namespace common\models;

use yii\helpers\Url;

class System {

    function Thaidate($dateformat = null) {
        $year = substr($dateformat, 0, 4);
        $month = substr($dateformat, 5, 2);
        $day = substr($dateformat, 8, 2);
        $thai = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

        if (strlen($dateformat) <= 10) {
            return $thaidate = (int) $day . " " . $thai[(int) $month] . " " . ($year + 543);
        } else {
            return $thaidate = (int) $day . " " . $thai[(int) $month] . " " . ($year + 543) . " " . substr($dateformat, 10);
        }
    }

    function GetimagesProduct($images = null) {

        if (!empty($images)) {
            $Urlimages = Url::to('@web/web/uploads/' . $images);
            $imagesproduct = str_replace('frontend', 'backend', $Urlimages);
            return $imagesproduct;
        } else {
            $Urlimages = Url::to('@web/web/img/none.png');
            $imagesproduct = str_replace('frontend', 'backend', $Urlimages);
            return $imagesproduct;
        }
    }

    function LinktoBackend($url = null) {
        return str_replace('frontend', 'backend/web', $url);
    }
    
    function LinktoFrontend($url = null) {
        return str_replace('backend/web', 'frontend', $url);
    }

}
