# PSR-4

**PSR** *PHP Standard Recommendation*

## O que é?

São recomendações de padrões básicos de codificação em php. Esta PSR define padrões de autoload de arquivos de classes.

O autoload facilita o uso de classes no decorrer do projeto, pois, conforme o crescimento do mesmo as complicações de uso das classes vão aumentando.

## Especificação

1. O termo "class" refere-se a classes, interfaces, traits e outras estruturas semelhantes.
2. Um nome de classe totalmente qualificado tem o seguinte formato:
   `\<NomeDoNamespace>(\<NomeDoSubNamespace>)*\<NomeDaClasse>`
    1. O namespace  **DEVE** ter um nome de namespace como nível máximo, também conhecido como "vendor namespace".
    2. O namespace **PODE** ter um ou mais sub-namespaces.
    3. O namespace **DEVE** ter um nome de classe final.
    4. Underscore(sublinhado) não tem significado especial em nenhum ponto do namespace.
    5. Caracteres alfabéticos **PODEM** ter qualquer combinação de minúsculo com maiúsculo em todo namespace.
    6. Todos os nomes de classes **DEVEM** ser referenciados diferenciando minúsculas e maiúsculas.
 3. Quando estiver carregando um arquivo que corresponde a um classname:
    1. TODO:


Pense no seguinte conjunto de diretórios e arquivos:

```shell
$tree
.
├── index.php
└── src
    ├── Arbitro.php
    ├── Estadio.php
    ├── Partida.php
    └── Time.php
```
Para utilizar todas as classes de `src/` no arquivo `index.php` seria necessário fazer o require de todas as classes como no exemplo a seguir:

```php
<?php

require 'src/Time.php';
require 'src/Estadio.php';
require 'src/Arbitro.php';
require 'src/Partida.php';
```

Usando o composer você pode definir o autoload de classes e definir os namespaces.

Arquivo base de `composer.json`:
```json
{
    "name": "hemilio/futebol",
    "description": "Teste com autoload",
    "type": "project",
    "license": "MIT",
    "autoload": {
        "psr-4": {
            "Hemilio\\Futebol\\": "src/"
        }
    },
    "authors": [
        {
            "name": "hemilioaraujo",
            "email": "hemilioaraujo@gmail.com"
        }
    ],
    "require": {}
}

```

Com o autoload definido no `composer.json` basta adicionar os namespaces nas classes que conforme o exemplo seria `namespace Hemilio\Futebol;`

Neste ponto o foco é no trecho de `autoload` onde veremos a utilização usando composer.

`"autoload"` : adiciona o campo para o composer identificar as definições.

`"psr-4"`: define que será usada a PSR-4 para os namespaces.

`"Hemilio\\Futebol\\"`: define o namespace `Hemilio\Futebol\` para o diretório `src/`.

Após esta alteração é necessário executar o comando `composer dump-autoload`.

Com a utilização do autoload e definição dos namespaces a utilização das classes ficaria assim:

```php
<?php
// aqui ele carrega verifica todas as classes
require_once __DIR__ . "/vendor/autoload.php";

// aqui são solicitadas as classes que serão usadas
// seguindo seus namespaces
use Hemilio\Futebol\Time;
use Hemilio\Futebol\Arbitro;
use Hemilio\Futebol\Estadio;
use Hemilio\Futebol\Partida;
```