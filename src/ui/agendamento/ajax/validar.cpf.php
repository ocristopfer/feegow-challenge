<?php
include_once __DIR__ . '/../../../resources/api/api.php';
include_once __DIR__ . '/../../../resources/api/utilidades/validacao/validar.cpf.php';

$requestBody =  Api::getRequestBody();

if (!isset($requestBody->cpf) || $requestBody->cpf == "") {
    echo json_encode(false);
} else {
    if (CPF::validar($requestBody->cpf)) {
        Api::resposta_JSON_Api(true);
    } else {
        Api::resposta_erro_Api_throw_errors(406);
    }
}
