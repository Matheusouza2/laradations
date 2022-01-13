<?php

namespace SertSoft\Laradations\Masks;

class Mtelefone
{
    public function putMask($value)
    {
        switch (strlen($value)){
            case 13:
                $formation = "+## (##) # ####-####";
                break;
            case 12:
                $formation = "+## (##) ####-####";
                break;
            case 11:
                $formation = "(##) # ####-####";
                break;
            case 10:
                $formation = "(##) ####-####";
                break;
            case 9:
                $formation = "# ####-####";
                break;
            case 8:
                $formation = "####-####";
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