<?php

namespace SertSoft\Laradations\Rules;

use Illuminate\Contracts\Validation\Rule;

class Renavam implements Rule
{
    /**
    * @param string $attribute
    * @param string $value
    * @return boolean
    */
    public function passes($attribute, $value)
    {
        $c =  preg_replace('/[^\d]/', '', (string) $value);
        
        $array = str_split($c);
        
        $digit = $this->determinarDigito($array);

        return $digit === (int) $array[4];
    }

    public function determinarDigito($renavam)
    {
        $resultante = 0;
        $contador = 0;

        for ($indice = 5; $indice >= 2; $indice--) {
            $resultante += $renavam[$contador] * $indice;
            $contador++;
        }

        $verificador = $resultante % 11;

        return $verificador >= 10 ? 0 : $verificador;
    }
}