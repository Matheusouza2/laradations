<?php

namespace SertSoft\Laradations;

use SertSoft\Laradations\ApiConsults\ConsultAnv;
use SertSoft\Laradations\ApiConsults\ConsultCep;
use SertSoft\Laradations\ApiConsults\ConsultCnpj;
use SertSoft\Laradations\ApiConsults\ConsultCorreios;
use SertSoft\Laradations\ApiConsults\ConsultProd;
use SertSoft\Laradations\ApiConsults\ConsultSus;

define('TOKEN', config('sertapi.api_token'));
define('ACTIVE', config('sertapi.use_api'));

class SertApi
{

    public static function consultas(array $options)
    {
        if (SertApi::valid()[0]) {
            switch ($options[0]){
                case 'cnpj':
                    $cnpj = new ConsultCnpj();
                    return $cnpj->consult($options[2]);
                    break;
                case 'cep':
                    $cep = new ConsultCep();
                    return $cep->consult($options[2]);
                    break;
                case 'anv':
                    $anv = new ConsultAnv();
                    return $anv->consult( $options[1], $options[2], (isset($options[3])?$options[3]:'') );
                    break;
                case 'ebct':
                    $ebct = new ConsultCorreios();
                    return $ebct->consult($options[2]);
                    break;
                case 'sus':
                    $sus = new ConsultSus();
                    return $sus->consult($options[1], $options[2]);
                    break;
                case 'prod':
                    $prod = new ConsultProd();
                    return $prod->consult($options[1], $options[2]);
                    break;
            }
        } else {
            return SertApi::valid()[1];
        }
    }

    private static function valid()
    {
        if (!ACTIVE) {
            return [false, 'API não está ativada, vá até config/sertapi.php e coloque TRUE em use_api'];
        } elseif (TOKEN == '') {
            return [false, 'Token de autenticação não informado no arquivo de configuração, vá até config/sertapi.php e informe seu token'];
        }
        return [true];
    }
}
