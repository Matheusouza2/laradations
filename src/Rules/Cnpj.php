<?php

namespace SertSoft\Laradations\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cnpj implements Rule
{
    /**
    * @param string $attribute
    * @param string $value
    * @return boolean
    */
    public function passes($attribute, $value)
    {
        $c =  preg_replace('/[^\d]/', '', $value);

        if (strlen($c) != 14 || preg_match("/^{$c[0]}{14}$/", $c)) {
            return false;
        }

        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        for ($i = 0, $n = 0; $i < 12; $n += $c[$i] * $b[++$i]);

        if ($c[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($i = 0, $n = 0; $i <= 12; $n += $c[$i] * $b[$i++]);

        if ($c[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }

}