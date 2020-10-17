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
        $records_affected = 0;
        return DbPersistenceManager::salvar($this->con, $objModel, self::getTableName(), self::getNomeChavePrimaria(), $records_affected, $this->getQueryCriarTabela());
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
        return DbPersistenceManager::listar($this->con, $query, AgendamentoModel::class, $arrayValores, $this->getQueryCriarTabela());
    }

    /**
     * Função responsável por listar todos os agendamentos
     *
     * @return void
     */
    public function listar()
    {
        $query = "SELECT * FROM " . self::getTableName();
        return DbPersistenceManager::listar($this->con, $query, AgendamentoModel::class, null, $this->getQueryCriarTabela());
    }

    /**
     * Função responsável por listar todos os agendamentos
     *
     * @return void
     */
    public function listar_por_especilidade($id_especilidade)
    {
        $arrayValores = array();
        $arrayValores[] = $id_especilidade;
        $query = "SELECT * FROM " . self::getTableName() . ' WHERE specialty_id = ?';
        return DbPersistenceManager::listar($this->con, $query, AgendamentoModel::class, $arrayValores, $this->getQueryCriarTabela());
    }

    private function getQueryCriarTabela()
    {
        $query = 'CREATE TABLE IF NOT EXISTS `agendamento` (
          `id` int NOT NULL AUTO_INCREMENT,
          `specialty_id` int DEFAULT NULL,
          `professional_id` int DEFAULT NULL,
          `name` varchar(150) DEFAULT NULL,
          `cpf` varchar(15) DEFAULT NULL,
          `source_id` int DEFAULT NULL,
          `birthdate` date DEFAULT NULL,
          `date_time` datetime DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;';

        return $query;
    }
}
