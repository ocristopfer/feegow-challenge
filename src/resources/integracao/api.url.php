<?php 
/**
 * Usada para salvar a url inicial do sistema, só utilizada quando o sistem não está hosperdado na raiz do servidor.
 * 
 */
class ApiUrl {
    public static function setUrl($url)
    {
        setcookie('urlRaiz', $url);
    }
}

?>