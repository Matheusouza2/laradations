<?php

namespace SertSoft\Laradations\ApiConsults;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class ConsultCep
{

    public function consult($cep)
    {
        $cep = preg_replace('/[^\d]/', '', $cep);
        try{
            $url = new Client(['base_uri' => 'https://api.sertsoft.com.br']);

            $response = $url->request('GET', "/EBCT/cep/$cep", [
                'headers' => [
                    'Authorization' => "Bearer " . TOKEN
                ]
            ]);

            $retorno = json_decode($response->getBody()->getContents());

            $response->getBody()->close();
        } catch (ClientException $e) {
            $trat = explode("\n", $e->getMessage());
            $retorno = $trat[1];
        }catch (ServerException $e){
            $retorno = ["error" => "Erro no servidor, entre em contato com o suporte da API"];
        }

        return $retorno;
    }
}