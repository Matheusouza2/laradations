<?php

namespace SertSoft\Laradations;
/**
 * IMPORTS ON MY OWNS
 */
use SertSoft\Laradations\Rules\Cpf;
use SertSoft\Laradations\Rules\Cnpj;
use SertSoft\Laradations\Rules\Certidao;
use SertSoft\Laradations\Rules\Cnh;
use SertSoft\Laradations\Rules\Cns;
use SertSoft\Laradations\Rules\Nis;
use SertSoft\Laradations\Rules\Placa;
use SertSoft\Laradations\Rules\Renavam;
use SertSoft\Laradations\Rules\TituloEleitoral;
/**
 * IMPORTS LARAVEL
 */
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Validation\Validator;

class Laradator extends Validator
{
    public function __construct(Translator $translator, array $data, array $rules, array $messages = [])
    {
        parent::__construct($translator, $data, $rules, $messages);
    }
    
    protected function validateCpf($attribute, $value): bool
    {
        $cpf = new Cpf();

        return $cpf->passes($attribute, $value);
    }

    protected function validateCnpj($attribute, $value): bool
    {
        $cnpj = new Cnpj();

        return $cnpj->passes($attribute, $value);
    }

    protected function validateCpfCnpj($attribute, $value): bool
    {
        $cpf = new Cpf();
        $cnpj = new Cnpj();

        return ($cpf->passes($attribute, $value) || $cnpj->passes($attribute, $value));
    }

    protected function validateCnh($attribute, $value): bool
    {
        $cnh = new Cnh();

        return $cnh->passes($attribute, $value);
    }

    protected function validateTituloEleitor($attribute, $value): bool
    {
        $tituloEleitoral = new TituloEleitoral();

        return $tituloEleitoral->passes($attribute, $value);
    }

    protected function validateNis($attribute, $value): bool
    {
        $nis = new Nis();

        return $nis->passes($attribute, $value);
    }

    protected function validateCns($attribute, $value): bool
    {
        $cns = new Cns();

        return $cns->passes($attribute, $value);
    }

    protected function validateCertidao($attribute, $value): bool
    {
        $certidao = new Certidao();

        return $certidao->passes($attribute, $value);
    }

    protected function validateRenavam($attribute, $value): bool
    {
        $renavam = new Renavam();

        return $renavam->passes($attribute, $value);
    }

    protected function validatePlaca($attribute, $value): bool
    {
        $placa = new Placa();

        return $placa->passes($attribute, $value);
    }
}