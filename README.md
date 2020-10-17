# Feegow Challenge

## Executar Usando Servidor web embutido do PHP

### Windows
- 1: Instalar a depêdencia Visual C++ Redistributable for Visual Studio 2015-2019 x86 ", está no diretório do projeto: depedencias\VC_redist.x86.exe"
- 2: Instalar o Google Chrome: https://www.google.pt/intl/pt-PT/chrome/
- 3: Instalar o MySQL Server e definir login e senha no arquivo src\resources\db\conexao.php.
- 4: Executar o Scritp src\resources\db\banco_agendamento.sql, para criação da tabela que é utilizar para amazenar o agendamento
- 3: Executar o scritp executarServidor.bat ele irá iniciar o servidor HTTP do php e abrir o navegador na pagina inicial.

## Executando em Servidor HTTP Comun:
-  1: Instalar um servidor HTTP com suporte para o PHP 7.4 (tendo o php a extensão mysqli habilitada) Ex: Apache ou IIS.
-  2: Instalar o Google Chrome: https://www.google.pt/intl/pt-PT/chrome/
-  3: Instalar o MySQL Server e definir login e senha no arquivo src\resources\db\conexao.php.
-  4: Executar o Scritp src\resources\db\banco_agendamento.sql, para criação da tabela que é utilizar para amazenar o agendamento
-  4: Após instalado as dependências inicias disponibilizar a pasta src no seu servidor HTTP;
-  5: É necessário usar o Google Chorme e executa-lo com os argumentos "--disable-web-security  --user-data-dir=%temp%\chromeTemp http://localhost/src", pois devido a politica de segurança do cors a API feegow não permiter requisições de origem diferente.
-  6: Acessa o enderaço raiz do servidor web que foi disponibilizado, se for na porta 80 o comando informando anterior já irá abrir diretamente o seu servidor web Ex: 127.0.0.1/src

## A aplicação foi testada em ambiente windows usando o Servidor Web Embutido do PHP 7.4 e IIS(Internet Information Services)10 com CGI e PHP 7.4
### obs: aplicação também foi testado no firefox, porem devido ao bloqueio do cors não foi possivel testar a comunicação com a Api feegow