<?php

namespace SertSoft\Laradations\ApiConsults;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class ConsultProd
{

    public function consult($filter, $value)
    {
        switch($filter){
            case 'gtin':
                $subUrl = "/PROD/gtin/$value";
                break;
            case 'nome':
                $subUrl = "/PROD/nome/$value";
                break;
            case 'marca':
                $subUrl = "/PROD/marca/$value";
                break;
            default:
                return json_encode(['erro' => 'Filtro não encontrado !']);
                break;
        }

        try{
            
            $url = new Client(['base_uri' => 'https://api.sertsoft.com.br']);
            
            $response = $url->request('GET', $subUrl, [
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