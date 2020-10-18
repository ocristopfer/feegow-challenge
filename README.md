# Feegow Challenge
 
## Tecnologias Utilizadas
    Back End: PHP, MYSQL (Usando um database framework, criado especialmente para a atividade)
    Front End: JQuery, Boostrap, Vue.JS
 
## Modos de Execução da aplicação:
### Executar Usando Servidor web embutido do PHP
 
- 1: Instalar a dependência Visual C++ Redistributable for Visual Studio 2015-2019 x86 ", está no diretório do projeto: depedencias\VC_redist.x86.exe"
- 2: Instalar o MySQL Server  (https://dev.mysql.com/downloads/windows/installer/8.0.html)  e definir login e senha no arquivo src\resources\db\conexao.php.
- 3: Se o sistema não conseguir criar o banco e as tabelas executar o Script src\resources\db\banco_agendamento.sql, para criação da tabela que é utilizado para armazenar o agendamento
- 4: Executar o script executarServidor.bat ele irá iniciar o servidor HTTP do php e abrir o navegador na página inicial.
 
 
### Executando em Servidor HTTP Comum:
-  1: Instalar um servidor HTTP com suporte para o PHP 7.4 (tendo o php a extensão mysqli habilitada) Ex: Apache ou IIS.
-  2: Instalar o MySQL Server (https://dev.mysql.com/downloads/windows/installer/8.0.html) e definir login e senha no arquivo src\resources\db\conexao.php.
-  3: Se o sistema não conseguir criar o banco e as tabelas executar o Script src\resources\db\banco_agendamento.sql, para criação da tabela que é utilizado para armazenar o agendamento
-  4: Após instalado as dependências inicias disponibilizar a pasta src no seu servidor HTTP;
-  5: Acessar o endereço do servidor HTTP ex: http://localhost

## Extra
    - Foi adicionado uma tela responsável por listar os agendamentos já salvos no banco de dados.
    - A aplicação foi testada em ambiente Windows sendo executado no Servidor Web Embutido do PHP 7.4 e IIS(Internet Information Services)10 com CGI e PHP 7.4
    - Foi criado um gateway em php que faz a comunicação da estrutura da api feegow criada no javascript com a api feegow, pois diretamente ocorro problemas de cors, pois a api não aceita requisições de origem diferente. 