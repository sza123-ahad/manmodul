<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

class Helper
{
    public static function kapital(string $string)
    {
        return strtoupper($string);
    }

    static public function formatindo($id){
        return number_format($id,'0',',','.');
    }
}