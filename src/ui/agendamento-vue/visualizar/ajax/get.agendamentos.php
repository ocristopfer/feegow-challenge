<?php
include_once __DIR__ . '/../../../../resources/api/api.php';
include_once __DIR__ . '/../../../../resources/db/conexao.php';
include_once __DIR__ . '/../../../../resources/api/dependencias/jsonmapper/JsonMapper.php';
include_once __DIR__ . '/../../../../resources/api/modulos/agendamento/agendamento.db.php';


$requestBody =  Api::getRequestBody();

$con = new Conexao();
$conSql = $con->startCon();
$agendamentoDb = new AgendamentoDB($conSql);

try {
    if(!isset($requestBody->especialidade_id) || $requestBody->especialidade_id == ""){
        $listaAgendamentos = $agendamentoDb->listar();
    }else{
        $listaAgendamentos = $agendamentoDb->listar_por_especilidade($requestBody->especialidade_id);
    }
    
    if (count($listaAgendamentos) > 0) {
        Api::resposta_JSON_Api($listaAgendamentos);
    } else {
        Api::resposta_erro_Api_throw_errors(400);
    }
} catch (Exception $th) {
    Api::resposta_erro_Api_throw_errors(400);
}
