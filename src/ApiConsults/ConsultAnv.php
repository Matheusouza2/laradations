<?php

namespace SertSoft\Laradations\ApiConsults;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class ConsultAnv
{

    /**
     * @param string $filter
     * @param string $value
     * @param string $situacao
     * @return string
     */
    public function consult($filter, $value, $situacao = null)
    {
        switch ($filter) {
            case "nome":
                $subUrl = "/ANV/medicamentos/nome";
                break;
            case "categoria":
                $subUrl = "/ANV/medicamentos/categoria";
                break;
            case "classe":
                $subUrl = "/ANV/medicamentos/classe";
                break;
            case "registro":
                $subUrl = "/ANV/medicamentos/registro";
                break;
            default:
                return json_encode(['error' => 'filtro não encontrado']);
                break;
        }
        try {
            $url = new Client(['base_uri' => 'https://api.sertsoft.com.br']);
            
            $response = $url->request('POST', $subUrl, [
                'headers' => [
                    'Authorization' => "Bearer " . TOKEN
                ],
                'form_params' => [
                    $filter => $value,
                    'situacao' => $situacao
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