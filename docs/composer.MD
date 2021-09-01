# Composer

## O que é?

Composer é uma ferramenta utilizada para gerenciar bibliotecas e pacotes externos
de um projeto PHP.

## Como instalar?

```shell
# 1
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
# 2
php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
# 3
php composer-setup.php
# 4
php -r "unlink('composer-setup.php');"
```

Se quiser definir como comando global no linux, basta copiar para o diretório `bin`:

```shell
sudo mv composer.phar /usr/local/bin/composer
```

## Iniciando o arquivo composer.json

O arquivo `composer.json` é onde ficam todas as definições de dependências.

Criando um arquivo básico:

```shell
composer init
```

Isso irá iniciar uma interface interativa que ao final dará um arquivo parecido com este:

```json

{
    "name": "hemilio/resources",
    "description": "Descrição do projeto.",
    "type": "project",
    "autoload": {
        "psr-4": {
            "Hemilio\\Resources\\": "src/"
        }
    },
    "authors": [
        {
            "name": "hemilioaraujo",
            "email": "seu_email@email.com"
        }
    ],
    "require": {}
}
```

## Instalando bibliotecas e/ou pacotes

```shell
composer require monolog/monolog
```

## Removendo bibliotecas e/ou pacotes

```shell
composer remove monolog/monolog
```

## Exibir informação sobre pacotes instalados
```shell
composer show
```
