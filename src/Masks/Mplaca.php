<?php

namespace SertSoft\Laradations\Masks;

class Mplaca
{
    public function putMask($value)
    {
        switch (strlen($value)){
            case 7:
                $formation = "###-####";
                break;
            default:
                return false;
                break;
        }
        
        $str = str_replace(" ","",$value);
        for($i=0;$i<strlen($str);$i++){
            $formation[strpos($formation, "#")] = $str[$i];
        }
        return $formation;
    }
}