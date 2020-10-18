<?php 

if(!isset($_SESSION)){
    session_start();
}

/**
 * Toda essa rotina só é usada quando o projeto não está hospedado na raiz do servidor web. 
 * Esse rotina tem o intuito de poder ajduar os arquivos JS a efetuarem as requisições corretamentes.
 */
if(!isset($_SESSION['urlRaiz']) || isset($arquivoInicial)){
    include_once __DIR__ . '/resources/integracao/api.url.php';
    $urlRaiz = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);    
    if(dirname($_SERVER['PHP_SELF']) != '\\'){
        ApiUrl::setUrl($urlRaiz);
    }
    $_SESSION['urlRaiz'] = $urlRaiz;
}

?>