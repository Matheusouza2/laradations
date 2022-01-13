<?php

namespace SertSoft\Laradations\Masks;

class Mcertidao
{
    public function putMask($value)
    {
        
        $formation = '######.##.##.####.#.#####.###.#######-##';

        $str = str_replace(" ","",$value);
        for($i=0;$i<strlen($str);$i++){
            $formation[strpos($formation, "#")] = $str[$i];
        }
        return $formation;
    }
}