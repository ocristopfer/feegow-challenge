<?php 
class Conexao{
    
    var $hostname,
        $username,
        $password,
        $database,
        $ConexaoSQL = null;
    
     function __construct()
    {
        $this->hostname = "localhost";
        $this->database = "feegow";
        $this->username = "root";
        $this->password = "123456";
    }

    public function startCon()
    {
        $hostname =  $this->hostname;
        $username =  $this->username;
        $password =  $this->password;
        $database =  $this->database;

        $this->ConexaoSQL = mysqli_connect($hostname, $username,  $password ,  $database);
        if (mysqli_connect_errno() == 1049) {
            $this->criarBanco();
            $this->ConexaoSQL = mysqli_connect($hostname, $username,  $password ,  $database);
        }else if(mysqli_connect_error()){
            $this->ConexaoSQL = null;
        }

        return $this->ConexaoSQL;
    }

    public function stopCon(){
        if ($this->ConexaoSQL) mysqli_close($this->ConexaoSQL);
    }

    private function criarBanco()
    {
        include_once __DIR__ . '/../api/db.persistence.manager.php';
        $conexao = new Conexao();
        $conexao->database = '';
        $con = $conexao->startCon();
        $query = "CREATE DATABASE IF NOT EXISTS `feegow`;";
        DbPersistenceManager::executarQuery($con, $query);
        $conexao->stopCon();
    }
}
?>

