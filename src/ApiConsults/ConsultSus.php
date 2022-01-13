<?php

namespace SertSoft\Laradations\ApiConsults;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class ConsultSus
{

    public function consult($filter, $value)
    {
        
        switch ($filter){
            case 'codigo':
                $subUrl = '/SUS/procedimento/codigo';
                break;
            case 'nome':
                $subUrl = '/SUS/procedimento/nome';
                break;
            default:
                return json_encode(['error' => 'Filtro não encontrado!']);
        }
        try{
            $url = new Client(['base_uri' => 'https://api.sertsoft.com.br']);

            $response = $url->request('POST', $subUrl, [
                'headers' => [
                    'Authorization' => "Bearer " . TOKEN
                ],
                'form_params' => [
                    $filter => $value
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