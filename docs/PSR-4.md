# PSR-4

**PSR** _PHP Standard Recommendation_

## O que é?

São recomendações de padrões básicos de codificação em php. Esta PSR define padrões de autoload de arquivos de classes.

O autoload facilita o uso de classes no decorrer do projeto, pois, conforme o crescimento do mesmo as complicações de uso das classes vão aumentando.

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