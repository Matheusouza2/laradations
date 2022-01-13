<?php

namespace SertSoft\Laradations\Rules;

use Illuminate\Contracts\Validation\Rule;

class Placa implements Rule
{
    /**
    * @param string $attribute
    * @param string $value
    * @return boolean
    */
    public function passes($attribute, $value)
    {
        $regexPlaca = '/^[A-Z][0-9]{5}$|^[0-9]{7}$|^[A-Z]{2}[0-9]{4}$|^[A-Z]{3}[0-9]{4}$|^[A-Z]{3}[0-9]{1}[A-Z]{1}[0-9]{2}$|^[A-Z]{3}[0-9]{2}[A-Z]{1}[0-9]{1}$/i';

        return preg_match($regexPlaca, $value) > 0;
    }
}