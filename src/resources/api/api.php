<?php
class Api
{

    /**
     * Retorna o body em JSON da requisição
     */
    static public function getRequestBody()
    {
        $str_request_body = file_get_contents("php://input");
        $json_request_body = json_decode("{}");
        if (isset($str_request_body)) {
            $json_request_body = json_decode($str_request_body);
            if (!isset($json_request_body)) {
                $json_request_body = json_decode("{}");
            }
        }

        return $json_request_body;
    }

    /**
     * Usado para responder um objeto como JSON
     *
     * @param [type] $resposta
     * Esse argumento será transformado em JSON
     * @return void
     */
    static public function resposta_JSON_Api($resposta)
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($resposta);
    }

    /**
     * Usado para responder erros no Header da requisição
     *
     * @param integer $status_code
     * @return void
     */
    static public function resposta_erro_Api_throw_errors(int $status_code = 400)
    {
        header('Content-Type: application/json');
        http_response_code($status_code);
        exit;
    }
}
