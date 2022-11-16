<?php

class conexao{


    //local host
    private static $dbtype = "mysql";
    private static $host = "localhost";
    private static $port = "3306";
    private static $user = "ususario_bd";
    private static $password = "senha_bd";
    private static $db = "nome_da_base";

    public function __construct()
    {
    }

    /*Evita que a classe seja clonada*/
    private function __clone()
    {
    }

    /*Método que destroi a conexão com banco de dados e remove da memória todas as variáveis setadas*/
    public function __destruct()
    {
        $this->disconnect();
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    /*Metodos que trazem o conteudo da variavel desejada
    @return   $xxx = conteudo da variavel solicitada*/
    private function getDBType()
    {
        return self::$dbtype;
    }

    private function getHost()
    {
        return self::$host;
    }

    private function getPort()
    {
        return self::$port;
    }

    private function getUser()
    {
        return self::$user;
    }

    private function getPassword()
    {
        return self::$password;
    }

    private function getDB()
    {
        return self::$db;
    }

    public function Conectar()
    {
        try {
            $this->conexao = new PDO($this->getDBType() . ":host=" . $this->getHost() . ";port=" . $this->getPort(), $this->getUser(), $this->getPassword(), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            //$this->CreateBanco($this->conexao);
            //echo 'Pessoa Servive';
        } catch (PDOException $i) {
            //se houver exceção, exibe
            die("Erro: <code>" . $i->getMessage() . "</code>");
        }

        return ($this->conexao);
    }

    public function getConn(){
        try {
            $this->conexao = new PDO($this->getDBType() . ":host=" . $this->getHost() . ";port=" . $this->getPort().";dbname=".$this->getDB(), $this->getUser(), $this->getPassword(), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (PDOException $i) {
            //se houver exceção, exibe
            die("Erro: <code>" . $i->getMessage() . "</code>");
        }

        return ($this->conexao);
    }

    private function disconnect()
    {
        $this->conexao = null;
    }

    public function CreateBanco($conn)
    {
        $query = "CREATE DATABASE IF NOT EXISTS " . $this->getDB() . ";
					  GRANT ALL ON " . $this->getDB() . ".* TO " . $this->getUser() . "@" . $this->getPassword() . ";
				      FLUSH PRIVILEGES;
					  use " . $this->getDB() . ";";
        $conn->exec($query);
        Conexao::__destruct();
    }

}
?>