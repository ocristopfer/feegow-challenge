<?php
include_once __DIR__ . '/../api/seguranca/token/token.php';
/**
 *Necesário para evitar o problema de cors nas requisições do javasscript
 */
class ApiFeegowGatewayService
{
    private $url = "https://api.feegow.com/v1/api/";
    private $token = '';

    function __construct($url)
    {
        $this->url = $url;
        $this->token = Token::getToken();
    }

    public function conectarApi($urlMetodo, $cUrlOptions = array())
    {
        try {
            $header = array('Content-Type: application/json', 'Accept: application/json');
            if ($this->token) {
                $header[] = "x-access-token: " . $this->token;
            }

            $cUrlOptions += array(
                CURLOPT_URL => $this->url . $urlMetodo,
                CURLOPT_HEADER => false,
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
            );

            $curl = curl_init();
            curl_setopt_array($curl, $cUrlOptions);
            $result = curl_exec($curl);
            curl_close($curl);

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } catch (Exception $th) {
            return false;
        }
    }
}
