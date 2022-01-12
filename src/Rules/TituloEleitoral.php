<?php

namespace SertSoft\Laradations\Rules;

use Illuminate\Contracts\Validation\Rule;

class TituloEleitoral implements Rule
{
    /**
    * @param string $attribute
    * @param string $value
    * @return boolean
    */
    public function passes($attribute, $value)
    {
        $c =  preg_replace('/[^\d]/', '', (string) $value);
        
        $uf = substr($c, -4, 2);

        if (
            ((mb_strlen($c) < 5) || (mb_strlen($c) > 13)) ||
            (str_repeat($c[1], mb_strlen($c)) == $c) ||
            ($uf < 1 || $uf > 28)
        ) {
            return false;
        }

        $dv = substr($c, -2);
        $base = 2;

        $sequencia = substr($c, 0, -4);

        for ($i = 0; $i < 2; $i++) {
            $fator = 9;
            $soma = 0;

            for ($j = (mb_strlen($sequencia) - 1); $j > -1; $j--) {
                $soma += $sequencia[$j] * $fator;

                if ($fator == $base) {
                    $fator = 10;
                }

                $fator--;
            }

            $digito = $soma % 11;

            if (($digito == 0) and ($uf < 3)) {
                $digito = 1;
            } elseif ($digito == 10) {
                $digito = 0;
            }

            if ($dv[$i] != $digito) {
                return false;
            }

            switch ($i) {
                case '0':
                    $sequencia = $uf . $digito;
                    break;
            }
        }

        return true;
    }

    /**
     * @return string
     */
    public function message()
    {
    	return 'O campo :attribute não é um Renavam válido.';
    }
}