<?php

namespace SertSoft\Laradations\Masks;

class Mcnpj
{
    public function putMask($value)
    {
        if(strlen($value) != 14)return false;

        $formation = '##.###.###/####-##';
        $str = str_replace(" ","",$value);
        for($i=0;$i<strlen($str);$i++){
            $formation[strpos($formation, "#")] = $str[$i];
        }
        return $formation;
    }
}