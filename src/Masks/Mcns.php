<?php

namespace SertSoft\Laradations\Masks;

class Mcns
{
    public function putMask($value)
    {
        if(strlen($value) != 15) return false;

        $formation = '### #### #### ####';
        $str = str_replace(" ","",$value);
        for($i=0;$i<strlen($str);$i++){
            $formation[strpos($formation, "#")] = $str[$i];
        }
        return $formation;
    }
}