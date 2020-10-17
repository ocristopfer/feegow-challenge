<?php
include_once __DIR__ . '/../../../../resources/api/api.php';
include_once __DIR__ . '/../../../../resources/db/conexao.php';
include_once __DIR__ . '/../../../../resources/api/dependencias/jsonmapper/JsonMapper.php';
include_once __DIR__ . '/../../../../resources/api/modulos/agendamento/agendamento.db.php';


$requestBody =  Api::getRequestBody();

$jmapper = new JsonMapper();
$requestBodyMap = $jmapper->map($requestBody, new AgendamentoModel());

$requestBodyMap = AgendamentoModel::parse($requestBodyMap);

foreach ($requestBodyMap as $key => $value) {
    if ($key != 'id' && $value == null) {
        Api::resposta_erro_Api_throw_errors(406);
    }
}

$con = new Conexao();
$conSql = $con->startCon();
$agendamentoDb = new AgendamentoDB($conSql);

try {
    if ($agendamentoDb->salvar($requestBodyMap)) {
        Api::resposta_JSON_Api(true);
    } else {
        Api::resposta_erro_Api_throw_errors(406);
    }
} catch (\Throwable $th) {
    //throw $th;
}
