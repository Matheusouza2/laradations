<?php

namespace SertSoft\Laradations\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cns implements Rule
{
    /**
    * @param string $attribute
    * @param string $value
    * @return boolean
    */
    public function passes($attribute, $value)
    {
        $c =  preg_replace('/[^\d]/', '', $value);

        if (preg_match("/[1-2][0-9]{10}00[0-1][0-9]/", $c) || preg_match("/[7-9][0-9]{14}/", $c)) {
            return $this->ponderacao($c) % 11 == 0;
        }

        return false;
    }

    private function ponderacao($value)
    {
        $sum = 0;

        for ($i = 0; $i < strlen($value); $i++) {
            $sum += $value[$i] * (15 - $i);
        }

        return $sum;
    }
}