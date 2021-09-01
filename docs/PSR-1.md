# PSR-1

**PSR** *PHP Standard Recommendation*
## O que é?
São recomendações de padrões básicos de codificação em php.

## 1. Overview
- Arquivos **DEVEM** usar somente as tags `<?php` e `<?=`;
- Arquivos **DEVEM** utilizar somente UTF-8 sem BOM (Byte order mark);
- Arquivos **DEVEM** declarar símbolos (classes, funções, constantes) ou causar efeitos (gerar saída, alterar configurações .ini) mas **NÃO DEVEM** fazer ambos (responsabilidade única);
  - Exemplo do que **EVITAR**:
    ```php
    <?php
    // efeito: alterar configuração do ini
    ini_set('error_reporting', E_ALL);

    // efeito: carregar um arquivo
    include "file.php";

    // efeito: generar saída
    echo "<html>\n";

    // declaração
    function foo()
    {
        // corpo da função
    }
    ```
- Namespaces e classes **DEVEM** seguir um "autoloading" PSR:[PSR-0 (descontinuada), PSR-4];
  - Isso quer dizer que cada classe está em um arquivo e está em um namespace de no mínimo um nível: o nome do fornecedor de nível superior.
  - Código utilizando PHP >= 5.3 **DEVEM** usar namespace formal.
    ```php
    <?php
    // PHP 5.3 e posteriores:
    namespace Vendor\Model;

    class Foo
    {
    }
    ```
  - Código utilizando PHP < 5.3 **DEVEM** usar a convenção de pseudo-namespace dos prefixos Vendor_ em nomes de classe.
    ```php
    <?php
    // PHP 5.2 e anteriores:
    class Vendor_Model_Foo
    {
    }
    ```
  
- Os nomes de classes, traits e interfaces **DEVEM** ser declarados em `StudlyCaps` (primeira letra maiúscula com cada sub-palavra com a primeira letra maiúscula);  
  - Exemplos:
    ```php
    <?php

    class Bicicleta
    {
    };

    class CarroDeBoi
    {
    };

    class MobileteFantasma
    {
    };
    ```
- Constantes de classes **DEVEM** ser declaradas com todas as letras maiúsculas e palavras separadas por underscore;
  - Exemplo:
    ```php
    <?php
    class CarroDeBoi{
        const RODAS = 2;
        const DIAMETRO_DA_RODA = 1500; //em milímetros
    }
    ```
- Os nomes de métodos **DEVEM** ser declarados em `camelCase` (primeira letra minúscula com cada sub-palavra com a primeira letra maiúscula);
  - Exemplo:
    ```php
    <?php
    class CarroDeBoi{
        public function movimentoParaFrente(){
            // corpo do método
        }
    }
    ```
