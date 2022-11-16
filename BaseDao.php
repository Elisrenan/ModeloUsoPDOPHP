<?php

require_once 'conexao.php';

class BaseGeralDao extends conexao
{
    public function __construct()
    {
        $this->Conectar();
    }

  //usado para criar tabelas
    public function CreateTable($sql){
        $conn=$this->getConn();
        $conn->exec($sql);
        conexao::__destruct();
    }

  //insere mas não retorna o id a linha inserida, retorna apenas a quantidade de linhas inseridas na tabela
    public function insertDB($sql,$params=null){
        
        $conexao=$this->getConn();
        $query=$conexao->prepare($sql);
        $query->execute($params); 
        $rs = $query->rowCount();
        conexao::__destruct();
        return $rs;
    }

  //retorna o id da linha inserida
    public function insertDB_ID($sql,$params=null){
        
        $conexao=$this->getConn();
        $query=$conexao->prepare($sql);
        $query->execute($params);
        $rs = array();
        $rsId = $conexao->lastInsertId();
        $rsCont = $query->rowCount();
        array_push($rs, $rsCont, $rsId);
        conexao::__destruct();
        return $rs;
    }

    #com prepare para gerar consulta apenas de quantidade de linhas
    public function consultaDB($sql,$params=null){
        
        $conexao=$this->getConn();
        $query=$conexao->prepare($sql);
        $query->execute($params); 
        $rs = $query->rowCount();
        conexao::__destruct();
        return $rs;
    }

  #para consultas sem verificação de sqlinjection onde a consulta é direta sem get, retorna um ou mais objetos
    public function consultaDBSelect($sql){
        
        $conexao=$this->getConn();
        $stmt = $conexao->prepare($sql);

        $stmt->execute();
        $objeto = $stmt->fetchAll(PDO::FETCH_OBJ);
        conexao::__destruct();
        return $objeto;
    }

  //para consultas com prepare retorna um ou mais objetos
    public function consultaDBSelectParamentros($sql,$params=null){
        
        $conexao=$this->getConn();
        $query=$conexao->prepare($sql);
        $query->execute($params); 

        $objeto = $query->fetchAll(PDO::FETCH_OBJ);
        conexao::__destruct();
        return $objeto;
    }
  

  //para atualizar tabelas
    public function updateDB($sql,$params=null){ 
        $conexao=$this->getConn();
        $query=$conexao->prepare($sql);
        $query->execute($params);
        $rs = $query->rowCount();
        conexao::__destruct();
        return $rs;
    }

  //para deletar tabelas
    public function deleteDB($sql,$params=null){
        $conexao=$this->getConn();
        $query=$conexao->prepare($sql);
        $query->execute($params);
        $rs = $query->rowCount();
        conexao::__destruct();
        return $rs;
    }

?>