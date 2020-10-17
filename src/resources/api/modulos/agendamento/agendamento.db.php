<?php
include_once __DIR__ . '/../../db.persistence.manager.php';
include_once __DIR__ . '/agendamento.model.php';

/**
 * Classe responsavel por lidar com a tabela de agendamentos no bancos de dados,
 * possuindo metodos para salvar, altera e listar os dados.
 */
class AgendamentoDB
{

    private $con;

    function __construct($conSql)
    {
        $this->con = $conSql;
    }

    static public function getTableName(): string
    {
        return "agendamento";
    }

    static public function getNomeChavePrimaria(): string
    {
        return "id";
    }

    /**
     * Função responsavel por salvar ou alterar um agendamento no banco de dados.
     *
     * @param AgendamentoModel $objModel
     * @return bool
     */
    public function salvar(AgendamentoModel $objModel)
    {
        return DbPersistenceManager::salvar($this->con, $objModel, self::getTableName(), self::getNomeChavePrimaria());
    }

    /**
     * Função responsavel por retonar um agendamento do banco pelo id dele.
     *
     * @param integer $id
     * @return array|null
     */
    public function get_por_id(int $id): ?array
    {
        $arrayValores = array();
        $query = "select * from " . self::getTableName() . " where " . self::getNomeChavePrimaria() . " = ? ";
        $arrayValores[] = $id;
        return DbPersistenceManager::listar($this->con, $query, AgendamentoModel::class, $arrayValores);
    }

    /**
     * Função responsável por listar todos os agendamentos
     *
     * @return void
     */
    public function listar()
    {
        $query = "SELECT * FROM " . self::getTableName();
        return DbPersistenceManager::listar($this->con, $query, AgendamentoModel::class);
    }
}
