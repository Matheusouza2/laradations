## Laradations
### Validador, formatador e gerador de documentos para Laraver by [SertSoft](https://sertsoft.com.br)
===

## Instalação 
### Laravel ^5.x 

Execute o composer para instalar o pacote na sua aplicação laravel: 
```
composer require sertsoft/laradations
```

Caso você pretenda usar a [SertAPI](https://api.sertsoft.com.br/docs) integrada utilize o artisan para publicar as configurações: 
```
php artisan vendor:publish --tag=config
```

---

Agora é só utilizar da praticidade do pacote `Laradations` no seu projeto. 

## Ferramentas 

### Validação de Documentos
| tipo_documento        |       validação       |
|           :           |          :=           |
|       cpf             | Válida se o CPF informado é válido         |
|       cnpj            | Válida se o CNPJ informado é válido        |
|       cns             | Válida se o CNS informado é válido         |
|       cpfCnpj         | Válida se o CPF ou CNPJ informado é válido |
|       cnh             | Válida se a CNH informada é válida         |
|       certidao        | Válida se a Certidão informada é válida (Certidão de nascimento/Casamento/Óbito)        |
|       nis             | Válida se o NIS informado é válido         |
|       placa           | Válida se a Placa informado é válido         |
|       renavam         | Válida se o Renavam informado é válido         |
|       tituloEleitor   | Válida se o Titulo de Eleitor informado é válido         |

### Utilização

```php

public function store(Request $request)
{
    //Realiza a validação dos campos
    $request->validate([
        'cpf'       => 'cpf',
        'cnpj'      => 'cnpj',
        'placa'     => 'placa',
        'documento' => 'cpfCnpj'
    ]);
}

```

---

### Máscara de Campos

| Márcaras | Retorno |
|   :       |   :=                                              |
| cpf       | Retorna o CPF informado com toda a sua pontuação  |
| cnpj      | Retorna o CNPJ informado com toda a sua pontuação |
| cep       | Retorna o CEP informado com toda a sua pontuação  |
| certidao  | Retorna a Certidão informado com toda a sua pontuação |
| cns       | Retorna o CNS informado com toda a sua pontuação  |
| nis       | Retorna o NIS informado com toda a sua pontuação  |
| placa     | Retorna a Placa(carro/moto) informado com toda a sua pontuação  |
| telefone  | Retorna o telefone informado com toda a sua pontuação, pode ser no formato com ou sem código do país, com ddd, sem ddd, com o nono digito ou sem |

### Utilização
Para utilização das máscaras você vai precisar primeiro importar a classe Laradator: 

```php
use SertSoft\Laradations\Laradator;
```

Após a importação basta realizar a utilização do metodo laraMask() :  

```php
public function show(){

    //Laradator::laraMask('cnpj', '11999888000110');
    //Laradator::laraMask('telefone', '81988523611');
    //Laradator::laraMask('telefone', '5581988523611');
    //Laradator::laraMask('telefone', '988523611');
    $cpf = Laradator::laraMask('cpf', '12345678988');

    echo $cpfFormatado;
}
```
O resultad será **123.456.789-88**

Caso queira utilizar uma mascara que não está disponivel na tabela acima, basta fazer da seguinte forma: 

```php
public function show(){

    $mascara = Laradator::laraMask('### ###-###', '123456789');

    echo $cpfFormatado;
}
```

O resultado será **123 456-789**

---

## SertAPI 

De inicio você deve definir seu Token na biblioteca, para fazer isso bastar ir no arquivo `config/sertapi.php` no seu projeto Laravel e alterar as duas linhas que tem no arquivo:

```php
    'use_api' => true, //Troque para TRUE para que seja ativa a API no seu projeto laravel.
    'api_token' => 'SEU_TOKEN_AQUI',//Informe seu token gerado no site para autenticar a aplicação.
```

Para quem utiliza a [SertAPI](https://api.sertsoft.com.br/docs) temos a integração total com o pacote, então após a instalação e publicação feita na parte de instalação e setado seu token e ativação da api no passo anterior você vai precisar realizar apenas a utilização do método da classe `SertApi`, **consultas**: 

```php
 SertApi::consultas();
```

O método consultas aceita apenas um parametro que é um array, esse array é estruturado de uma forma estatica e deve ser sempre seguido o modelo: 

| index | propriedade |
|   :   |   :=                                              |
|  0    | O index 0 é utilizado para definir qual a consulta que será realizada.  |
|  1    | O index 1 indica qual filtro será utilizado na consulta a API           |
|  2    | O index 2 carrega o valor que será utilizado pelo filtro                |
|  3    | O index 3 é opcional e só funciona nas consultas da Anvisa              |

O index 0 pode conter os valores `anv`, `cep`, `cnpj`, `ebct`, `sus` e `prod` que indicam o tipo de consulta que será realizada pela biblioteca. 
O index 1 vai conter os valores dos filtros, para `anv` => `nome`, `categoria`, `classe`, `registro`
para `sus` => `codigo`, `nome` e para `prod` => `gtin`, `nome`, `marca`, *para os demais o index 1 deve permanecer com valor ''*
O index 2 possui o valor que será filtrado, podendo ser um nome de um medicamento, gtin de uma mercadoria ou um código de rastreio dos correios, vai depender de como você está utilizando os index anteriores. 
O index 3 serve para filtrar os resultados da Anvisa em medicamentos apenas Cancelados ou apenas Ativos, para isso os valores são respectivamente `cancelado` e `valido`.

### Utilização

Inicialmente você deve importar a classe SertApi no seu Controller que for utilizar a API: 

```php
use SertSoft\Laradations\SertApi;
```
Agora vamos fazer uma consulta da Anvisa, com o nome do médicamento sendo **dorflex** e apenas os registros com registros ativos: 

```php
echo SertApi::consultas([
        'anv',
        'nome',
        'dorflex',
        'valido'
    ]);
```

O retorno será um array: 

```php
[
  0 => {
    "nome": "DORFLEX",
    "numero_registro": 183260354,
    "vencimento_registro": "01/08/2026",
    "classe": "RELAXANTES MUSCULARES CENTRAIS-ASSOCIACOES MEDICAMENTOSAS",
    "categoria": "NOVO",
    "detentora_registro": "10588595001092 - SANOFI MEDLEY FARMACÊUTICA LTDA.",
    "situacao_registro": "VÁLIDO"
  }
]
```

Agora se quisermos consultar uma mercadoria com o GTIN **7891000103364** que é de um chocolate da Nestlé

```php
echo SertApi::consultas([
    'prod',
    'gtin',
    '7891000103364',    
]);
```

A resposta seria: 

```php
[
  "produto": {
    "gtin": 7891000103364,
    "descricao": "CHOCOLATE CLASSIC NESTLÉ AO LEITE",
    "fabricante": "NESTLE",
    "preco_min": "5,49",
    "preco_med": "6,72",
    "preco_max": "7,95",
    "embalagem": "Unidade",
    "qtd_embalagem": 1,
    "categoria": "NÃO SE APLICA"
  },
  "ncm": {
    "codigo": 18063210,
    "descricao": "Cacau e suas preparações - Chocolate e outras preparações alimentícias que contenham cacau. - Outros, em tabletes, barras e paus: - Não recheados - Chocolate"
  },
  "cest": {
    "codigo": 1700300,
    "descricao": "Chocolate em barras, tabletes ou blocos ou no estado líquido, em pasta, em pó, grânulos ou formas semelhantes, em recipientes ou embalagens imediatas de conteúdo inferior ou igual a 2 kg"
  }
]

```

Para finalizar se quisermos rastrear uma mercadoria dos correios deveremos fazer: 

```php
echo SertApi::consultas([
    'ebct',
    '',
    'SEU_COD_RASTREIO',    
]);
```

```php
[
    "0": {
      "dia": "05/01/2022",
      "hora": "15:22",
      "local": "Sao Paulo/SP",
      "acao": "Objeto postado",
      "mensagem": "Objeto postado ",
      "modificado": "há 8 dias"
    }
]
```

Se não conhece ainda a API consulta a [documentação](https://api.sertsoft.com.br). Em caso de dúvidas ou problemas use os [issues](https://github.com/Matheusouza2/laradations/issues) ou entre em contato com o suporte pelo [whatsapp](https://api.whatsapp.com/send?phone=5587981166987&text=Tenho%20algumas%20duvidas%20sobre%20a%20SertAPI)