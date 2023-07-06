<?php

namespace SertSoft\Laradations\Sanitize;

use Illuminate\Contracts\Validation\Rule;

class Sanitize
{
    /**
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function passes($value, $type, $mask = null)
    {
        $c = "";
        switch ($type) {
            case 'cpf':
                $c = str_replace([".", "-"], "", $value);
                break;
            case 'telefone':
                $c = str_replace(["(", ")", "-", " "], "", $value);
                break;
            case 'cns':
                $c = str_replace(" ", "", $value);
                break;
            case 'cep':
                $c = str_replace([".", "-", " "], "", $value);
                break;
            case 'cnpj':
                $c = str_replace([".", "-", "/"], "", $value);
                break;
            case 'nis':
                $c = str_replace([".", " "], "", $value);
                break;
            case 'custom':
                $c = str_replace($mask, "", $value);
                break;
            case 'money':
                $c = str_replace(["R$", " ", ".", ","], ["", "", "", "."], $value);
                break;
            default:
                $c = $value;
                break;
        }

        return $c;
    }
}
