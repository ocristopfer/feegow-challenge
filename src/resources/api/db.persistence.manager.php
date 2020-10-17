<?php
include_once __DIR__ . '/../db/conexao.php';
include_once __DIR__  . '/../api/utilidades/string/string.utf8.php';

/**
 * Mini framework de persietencia, que faz toda a comunicação entra a classe db e a respetitiva tabela no banco de dados.

 */
class DbPersistenceManager
{

    /**
     * Metodo que insere ou atualiza um objeto no banco
     *
     * @param [type] $con
     * Conexão com o banco
     * @param [type] $objModel
     * instancia do objeto (é passdo o endereço de memoria do objeto, caso sejá um insert ele vai inserir o id gerado no banco ao objeto)
     * @param [type] $tableName
     * nome da tabela
     * @param [type] $nomeChavePrimaria
     * nome da chave primeira
     * @param integer $records_affected
     * Quantidade de registros afetados
     * @param string $createTableQuery
     * Query que o persitence irá executar se ocorrer erro de tabela não encontrada. 
     * @return boolean
     */
    static public function salvar($con, &$objModel, $tableName, $nomeChavePrimaria, &$records_affected = 0, string $createTableQuery = '')
    {
        try {
            if ($objModel->id != null) {
                $fieldNamesAndValues = "";
                foreach ($objModel as $key => $value) {
                    if ($fieldNamesAndValues != "") {
                        $fieldNamesAndValues .= ",";
                    }
                    $fieldNamesAndValues .= "{$key}=?";
                    $arrayValores[] = $value;
                }
                $query = "UPDATE {$tableName} SET {$fieldNamesAndValues} WHERE {$nomeChavePrimaria} = {$objModel->id};";
            } else {
                $fieldNames = "";
                $values = "";
                foreach ($objModel as $key => $value) {
                    if ($key != $nomeChavePrimaria && $value != null) {
                        if ($fieldNames != "") {
                            $fieldNames .= ",";
                        }
                        if ($values != "") {
                            $values .= ",";
                        }
                        $fieldNames .= $key;
                        $values .= "?";
                        $arrayValores[] = $value;
                    }
                }

                $query = "INSERT INTO {$tableName} ({$fieldNames}) VALUES ({$values});";
            }

            //Previne mensagens de Warning na execução da query
            error_reporting(E_ERROR | E_PARSE);

            if (!isset($arrayValores) or empty($arrayValores)) {
                $arrayValores = array();
            }

            if ($con != null) {

                $statement = $con->prepare($query);
                if ($statement != null) {

                    if ($arrayValores != null) {
                        $types = str_repeat('s', count($arrayValores));
                        $statement->bind_param($types, ...$arrayValores);
                    }

                    $statement->execute();
                    $records_affected = $statement->affected_rows;

                    if ($records_affected == 1) {
                        if ($objModel->{$nomeChavePrimaria} == null) {
                            $objModel->{$nomeChavePrimaria} = $statement->insert_id;
                        }
                    }
                }
                $statement->close();
            }

            if ($con->errno == 1146) {
                self::executarQuery($con, $createTableQuery);
                return self::executarQuery($con, $query, $arrayValores, $records_affected);
            }

            if ($records_affected == 1) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            return false;
        }
    }

    /**
     * Metodo que retorna a lista do banco já preenchendo o objeto informado.
     *
     * @param [type] $con
     * @param string $query
     * @param string $nomeClasse
     * @param array $arrayValores
     * @param string $createTableQuery
     * Query que o persitence irá executar se ocorrer erro de tabela não encontrada.
     * @return mixed
     */
    static public function listar($con, string $query, string  $nomeClasse, array $arrayValores = null, string $createTableQuery = '')
    {
        $retorno = array();
        $listagem = self::executarQuery($con, $query, $arrayValores, $records_affected, $createTableQuery);
        foreach ($listagem  as $key => $value) {
            $obj = new $nomeClasse();
            foreach ($value as $key => $value) {
                $obj->{$key} = $value;
            }
            $retorno[] = $obj;
        }
        return $retorno;
    }

    /**
     * Metódo que executa a query simples sem associa ao objeto.
     *
     * @param [type] $con
     * Conexão com o banco de dados.
     * @param string $query
     * Query a ser executada.
     * @param array $arrayValores
     * Parametros para a query.
     * @param integer $records_affected 
     * quantidade de registros afetados
     * @param string $createTableQuery
     * Query que o persitence irá executar se ocorrer erro de tabela não encontrada.
     * @return array
     */
    static public function executarQuery($con, string $query, array $arrayValores = null, &$records_affected = 0, string $createTableQuery = '')
    {
        try {
            //Previne mensagens de Warning na execução da query
            error_reporting(E_ERROR | E_PARSE);

            $listagem = array();

            if (!isset($arrayValores) or empty($arrayValores)) {
                $arrayValores = array();
            }

            if ($con != null) {

                $statement = $con->prepare($query);
                if ($statement != null || $statement != false) {

                    if ($arrayValores != null) {
                        $types = str_repeat('s', count($arrayValores));
                        $statement->bind_param($types, ...$arrayValores);
                    }

                    $statement->execute();
                    $records_affected = $statement->affected_rows;

                    $result = $statement->get_result();
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $listagem[] = $row;
                        }
                    }
                    $statement->close();
                }
            }
            if ($con->errno == 1146) {
                self::executarQuery($con, $createTableQuery);
                return self::executarQuery($con, $query, $arrayValores, $records_affected);
            }
            if ($records_affected && $listagem == null) {
                return true;
            } else {
                return $listagem;
            }
        } catch (Exception $th) {
            return false;
        }
    }
}
