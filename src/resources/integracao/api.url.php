<?php 

class ApiUrl {
    public static function setUrl($url)
    {
        setcookie('url', $url);
    }
}

?>