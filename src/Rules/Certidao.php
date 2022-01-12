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

        $num = substr($c, 0, -2);
        $dv = substr($c, -2);

        $dv1 = $this->ponderacao($num) % 11;
        $dv1 = $dv1 > 9 ? 1 : $dv1;
        $dv2 = $this->ponderacao($num . $dv1) % 11;
        $dv2 = $dv2 > 9 ? 1 : $dv2;

        // Compara o dv recebido com os dois numeros calculados
        if ($dv === $dv1 . $dv2) {
            return true;
        }

        return false;
    }

    private function ponderacao($value)
    {
        $sum = 0;

        $multplier = 32 - strlen($value);

        for ($i = 0; $i < strlen($value); $i++) {
            $sum += $value[$i] * $multplier;

            $multplier += 1;
            $multplier = $multplier > 10 ? 0 : $multplier;
        }

        return $sum;
    }

    /**
     * @return string
     */
    public function message()
    {
    	return 'O campo :attribute não é uma Certidão válida.';
    }
}