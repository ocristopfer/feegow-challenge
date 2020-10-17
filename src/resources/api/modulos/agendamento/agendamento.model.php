<?php

/**
 * Modelo de dados que o AgendamentoDB irá usar para processador os dados da tabela agendamento.
 **/
class AgendamentoModel
{
    public $id;
    public $specialty_id;
    public $professional_id;
    public $name;
    public $cpf;
    public $source_id;
    public $birthdate;
    public $date_time;


    static public function parse($obj): AgendamentoModel
    {
        return $obj;
    }
}
