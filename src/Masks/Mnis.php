<?php

namespace SertSoft\Laradations\Masks;

class Mnis
{
    public function putMask($value)
    {
        $formation = '###.#####.##-#';
        $str = str_replace(" ","",$value);
        for($i=0;$i<strlen($str);$i++){
            $formation[strpos($formation, "#")] = $str[$i];
        }
        return $formation;
    }
}