<?php

namespace SertSoft\Laradations\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cnh implements Rule
{
    /**
    * @param string $attribute
    * @param string $value
    * @return boolean
    */
    public function passes($attribute, $value)
    {
        $c =  preg_replace('/[^\d]/', '', $value);

        if (strlen($c) != 11 || ((int) $value === 0)) {
            return false;
        }

        $part = substr($value, 0, 9);

        for ($i = 0 , $j = 2, $s = 0; $i < strlen($part); $i++, $j++) {
            $s += (int) $part[$i] * $j;
        }

        $rest = $s % 11;
        if ($rest <= 1) {
            $vl1 = 0;
        } else {
            $vl1 = 11 - $rest;
        }

        $part = $vl1 . $part;

        for ($i = 0, $j = 2, $s = 0; $i < strlen($part); $i++, $j++) {
            $s += (int) $part[$i] * $j;
        }

        $rest = $s % 11;
        if ($rest <= 1) {
            $dv2 = 0;
        } else {
            $dv2 = 11 - $rest;
        }

        return $vl1 . $dv2 == substr($value, -2);
    }
}