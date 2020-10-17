# Feegow Challenge

## Executar Usando PHP Debug

### Windows
- 1: Instalar a depêdencia Visual C++ Redistributable for Visual Studio 2015-2019 x86 ", está no diretório do projeto: depedencias\VC_redist.x86.exe"
- 2: Instalar o Google Chrome: https://www.google.pt/intl/pt-PT/chrome/
- 3: Instalar o MySQL Server e definir login e senha no arquivo src\resources\db\conexao.php.
- 4: Executar o Scritp src\resources\db\banco_agendamento.sql, para criação da tabela que é utilizar para amazenar o agendamento
- 3: Executar o scritp executarServidor.bat ele irá iniciar o servidor HTTP do php e abrir o navegador na pagina inicial.

## Executando em Servidor HTTP:
-  1: Servidor HTTP com plugin para execução de script PHP 7.4 instalado Ex: Apache ou IIS.
-  2: Após instalado disponibilizar a pasta src no servidor HTTP;
-  3: Servidor MySQL e que sejá definido o login e senha no arquivo src\resources\db\conexao.php.
-  4: Necessário a execução do script banco_agendamento.sql, para criação da tabela que registra os agendamentos.
-  5: É necessário usar o Google Chorme (aplicação também foi testado no firefox, porem devido ao bloqueio do cors não foi possivel testar a comunicação com  Api feegow), sendo executado com o argumento "--disable-web-security  --user-data-dir=~/chromeTemp", pois devido a politica de segurança do cors a API feegow não permiter requisições de origem diferente.
-  6: Acessa o enderaço raiz do servidor web que foi disponibilizado Ex: 127.0.0.1/src

#### Obs: toda aplicação foi testar em um sevidor IIS roando PHP 7.4
