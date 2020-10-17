# Feegow Challenge
 
## Tecnologias Utilizadas
    Back End: PHP, MYSQL (Usando um database framework, criado especialmente para a atividade)
    Front End: JQuery, Boostrap, Vue.JS
 
 
## Modos de Execução da aplicação:
### Executar Usando Servidor web embutido do PHP
 
- 1: Instalar a dependência Visual C++ Redistributable for Visual Studio 2015-2019 x86 ", está no diretório do projeto: depedencias\VC_redist.x86.exe"
- 2: Instalar o Google Chrome: https://www.google.pt/intl/pt-PT/chrome/
- 3: Instalar o MySQL Server  (https://dev.mysql.com/downloads/windows/installer/8.0.html)  e definir login e senha no arquivo src\resources\db\conexao.php.
- 4: Se o sistema não conseguir criar o banco e as tabelas executar o Script src\resources\db\banco_agendamento.sql, para criação da tabela que é utilizado para armazenar o agendamento
- 3: Executar o script executarServidor.bat ele irá iniciar o servidor HTTP do php e abrir o navegador na página inicial.
 
 
### Executando em Servidor HTTP Comum:
-  1: Instalar um servidor HTTP com suporte para o PHP 7.4 (tendo o php a extensão mysqli habilitada) Ex: Apache ou IIS.
-  2: Instalar o Google Chrome: https://www.google.pt/intl/pt-PT/chrome/
-  3: Instalar o MySQL Server (https://dev.mysql.com/downloads/windows/installer/8.0.html) e definir login e senha no arquivo src\resources\db\conexao.php.
-  4: Se o sistema não conseguir criar o banco e as tabelas executar o Script src\resources\db\banco_agendamento.sql, para criação da tabela que é utilizado para armazenar o agendamento
-  4: Após instalado as dependências inicias disponibilizar a pasta src no seu servidor HTTP;
-  5: É necessário usar o Google Chorme e executá-lo com os argumentos "--disable-web-security  --user-data-dir=%temp%\chromeTemp http://localhost/src", pois devido a política de segurança do cors a API feegow não permite requisições de origem diferente.
-  6: Acessar o endereço raiz do servidor web que foi disponibilizado, se for na porta 80 o comando informando anterior já irá abrir diretamente o seu servidor web Ex: 127.0.0.1/src
 
## Extra
    - Foi adicionado uma tela responsável por listar os agendamentos já salvos no banco de dados.
    - A aplicação foi testada em ambiente Windows sendo executado no Servidor Web Embutido do PHP 7.4 e IIS(Internet Information Services)10 com CGI e PHP 7.4  e usando o Google Chrome para carregar, a mesma também foi testado no firefox, porém devido ao bloqueio do cors não foi possível testar a comunicação com a Api feegow
