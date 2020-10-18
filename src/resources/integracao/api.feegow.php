<?php
header("Content-Type: application/json");
/**
 * A ideia original foi usar requisições via javascritp para a api feegow, porem devido a problema de cors foi criado esse gateway, 
 * que funciona como uma ponte entre toda a estrura criada em js como a api feegow;
 */
include_once __DIR__ . '/../api/api.php';
include_once __DIR__ . '/api.feegow.gateway.php';

try {
    $headers = getallheaders();
    $metodo = $headers['Metodo'];
    $arrayCurl = array();

    if ($headers['Requesttype'] == 'GET') {
        if (count($_GET) > 0) {
            $metodo .= '?' . http_build_query($_GET);
        }
    } else {
        $arrayCurl = array(
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode(API::getRequestBody())
        );
    }

    $apiFeegowGatewayService = new ApiFeegowGatewayService('https://api.feegow.com/v1/api/');
    $result = $apiFeegowGatewayService->conectarApi($metodo, $arrayCurl);
    Api::resposta_JSON_Api(json_decode($result));
} catch (Exception $th) {
    Api::resposta_erro_Api_throw_errors(400);
}
