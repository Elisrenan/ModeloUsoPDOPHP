<?php

require_once 'baseGeralDao.php';

class UsuarioService{
    
	public function __construct(){
        $this->Base = new BaseGeralDao();
	}

    
     //insere uma usuario no banco de dados e nesse caso o insert tem que ser respectivamente na mesma ordem
  //que as colunas estão no banco de dados, caso contrário dará um erro
	public function inserirUsuario($user_cad, $senha_cad, $cidade_cad){
        $query = "INSERT INTO usuario (user, senha, cidade, sessao, data_cadastro, data_que_fez_logof) 
        VALUES (:user_cad, :senha_cad, :cidade_cad, 0, current_timestamp(), current_timestamp());";

        $senha_cad = md5($senha_cad);	

        //o prepare em pdo você passa um array setando a coluna que quer receber as informações
    // e no seu sql vc recebe esses mesmos dados
        $prepare = [":user_cad" => $user_cad, ":senha_cad" => $senha_cad, ":cidade_cad" => $cidade_cad];
        //chama a base
        $this->Base = new BaseGeralDao();
        //insere e retorna a quantidade de linhas afetadas para a controller
        return $this->Base->insertDB($query,$prepare);

     }

    public function VERIFICAR_SE_USUARIO_EXISTE($user){
        $query = "SELECT * FROM usuario WHERE user = :user;";
        $prepare = [':user' => $user ];
        $this->Base = new BaseGeralDao();
        return $this->Base->consultaDB($query,$prepare); 
    }

   
    public function PEGAR_DADOS_USUARIO($user,$senha){
        $query = "SELECT nome, cidade, sessao
        FROM usuario WHERE user = :user AND senha = :senha;";
        $prepare = [':user' => user, ':senha' => $senha];
        $this->Base = new BaseGeralDao();
        return $this->Base->consultaDBSelectParamentros($query,$prepare); 
    }

    public function FAZER_LOGOF_USUARIO($user){ 
        $query = "UPDATE usuario 
                    SET sessao = 0,
                        data_que_fez_logof = current_timestamp()
        WHERE user = :user";
        $prepare = [':user'=> $user];
        $this->Base = new BaseGeralDao();
        return $this->Base->updateDB($query,$prepare);
    }

    public function VERIFICAR_LOGIN_SENHA($user,$senha){ 
        $query = "SELECT * FROM usuario WHERE user = :user AND senha = :senha;";
        $prepare = [':user' => $user, ':senha' => $senha];
        $this->Base = new BaseGeralDao();
        return $this->Base->consultaDB($query,$prepare); 
    }

    function DELETAR_USUARIO($user) {
        $query = "DELETE FROM usuario WHERE user = :user";
        $this->Base = new BaseGeralDao();
        $prepare = [':user' => $user];
        return $this->Base->deleteDB($query,$prepare);
    }


}

?>