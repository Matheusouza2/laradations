<?php

namespace SertSoft\Laradations\Rules;

use Illuminate\Contracts\Validation\Rule;

class Nis implements Rule
{
    /**
    * @param string $attribute
    * @param string $value
    * @return boolean
    */
    public function passes($attribute, $value)
    {
        $nis =  preg_replace('/[^\d]/', '', $value);
        $nis = sprintf('%011s', $nis);

        if (strlen($nis) != 11 || preg_match("/^{$nis[0]}{11}$/", $nis)) {
            return false;
        }

        for ($d = 0, $p = 2, $c = 9; $c >= 0; $c--, ($p < 9) ? $p++ : $p = 2) {
            $d += $nis[$c] * $p;
        }

        return ($nis[10] == (((10 * $d) % 11) % 10));
    }
}