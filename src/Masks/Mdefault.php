<?php

namespace SertSoft\Laradations\Masks;

class Mdefault
{
    public function putMask($formation, $value)
    {
        $str = str_replace(" ","",$value);
        for($i=0;$i<strlen($str);$i++){
            $formation[strpos($formation, "#")] = $str[$i];
        }
        return $formation;
    }
}