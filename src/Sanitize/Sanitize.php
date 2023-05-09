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
    public function passes($value, $type)
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
            default:
                $c = $value;
                break;
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
