<?php

namespace SertSoft\Laradations;

use GuzzleHttp\Client;

class SertApi
{

    public static function consultaCnpj($cnpj)
    {
        $cnpj = preg_replace('/[^\d]/', '', $cnpj);

        $token = config('sertapi.api_token');
        
        $url = new Client(['base_uri' => 'https://api.sertsoft.com.br']);

        $response = $url->request('GET', "/cnpj/$cnpj", [
            'headers' => [
                'Authorization' => "Bearer $token"
            ]
        ]);

        $retorno = json_decode($response->getBody()->getContents());

        $response->getBody()->close();

        return $retorno;
    }

    public static function consultaCep()
    {

    }

    public static function rastreioCorreios()
    {

    }

    public static function consultaAnvisa()
    {

    }

    public static function consultaSus()
    {

    }

    public static function consultaProd()
    {

    }
}