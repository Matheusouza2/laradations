<?php

namespace SertSoft\Laradations\Rules;

use Illuminate\Contracts\Validation\Rule;

class Certidao implements Rule
{
    /**
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function passes($attribute, $value)
    {
        $c =  preg_replace('/[^\d]/', '', $value);

        if (!preg_match("/[0-9]{32}/", $c)) {
            return false;
        }

        return $c;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A Certidão informada é invalida';
    }
}
