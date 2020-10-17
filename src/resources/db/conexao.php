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
        $this->password = "suporte";
    }

    public function startCon()
    {
        $hostname =  $this->hostname;
        $username =  $this->username;
        $password =  $this->password;
        $database =  $this->database;

        $this->ConexaoSQL = mysqli_connect($hostname, $username,  $password ,  $database);
        if (mysqli_connect_errno()) {
            $this->ConexaoSQL = null;
        }

        return $this->ConexaoSQL;
    }

    public function stopCon(){
        if ($this->ConexaoSQL) mysqli_close($this->ConexaoSQL);
    }
}
?>

