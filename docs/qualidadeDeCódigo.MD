# phpcs
## php code sniffer

Verifica se o código está infringindo regras dos padrões: PSR1, PSR2, PSR12, PEAR e outros padrões.

### Alguns comandos mais importantes

Verifica recursivamente todos os arquivos do diretório `app/` com o relatório colorido:  
`phpcs --colors app/`

|Parâmetro|Função|
|---|---|
|`-l`|Sem recursão|
|`-n`|Sem warnings, somente errors|
|`--colors`|Saída do terminal com caracteres coloridos|
|`--version`|Exibe a versão do phpcs|
|`--help`|Exibe a lista de comandos possíveis|
|`--config-set`|Definir configurações padrão|

### Setar configurações do phpcs

Definir o estilo de código padrão:  
`phpcs --config-set default_standard PSR12`

Definir output com cores por padrão:  
`phpcs --config-set colors 1`

# phpmd
## PHP mess detector

Verifica as regras a seguir:

- **cleancode** (Clean Code Rules): aplica regras de clean code, incluindo as regras de SOLID e Object Calisthenics;
- **codesize** (Code Size Rules): regras aplicadas para busca referente ao tamanho do código;
- **controversial** (Controversial Rules): Verifica regras controversas, como acesso a variáveis super-global diretamente, utilização de CamelCase;
- **design** (Design Rules): Regras referentes a design de sua aplicação;
- **naming** (Naming Rules): Regras de nomeação, verificação de nomes muito longos ou curtos;
- **unusedcode** (Unused Code Rules): Verifica código não utilizado em seu projeto;