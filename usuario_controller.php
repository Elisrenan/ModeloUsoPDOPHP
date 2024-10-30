<?php

    require "usuario.service.php";
	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;


  
if($acao == 'acessar')
    {       
        $usuario_service = new UsuarioService(); 
        $usuario_login = strtolower($_POST['user']);
        $existe_usuario = $usuario_service->VERIFICAR_SE_USUARIO_EXISTE($usuario_login);
        //se existe o usuario entra
        if ($existe_usuario == 1) {
            $senha = md5($_POST['senha']);
            $existe_senha = $usuario_service->VERIFICAR_LOGIN_SENHA($usuario_login,$senha);
            // se o usuario e senha estão corretos entra e pega os dados do objeto
            if ($existe_senha == 1) {
                //pega o objeto usuario e coloca na variavel info_user
                $info_user = $usuario_service->PEGAR_DADOS_USUARIO($usuario_login,$senha);
                $dataAtualizacao = date('d/m/Y H:i');

              //usa o foreach para percorrer o objeto e acessar as colunas da tabela
                foreach ($info_user as $indice => $dados) {
                        $_SESSION['Acessar'] = true;
                        $_SESSION['nome'] = $dados->nome;  
                        $_SESSION['cidade'] = $dados->cidade; 
                        //ativa a sessão para mostrar o usuario online
                        $_SESSION['sessao'] = $dados->sessao;  
                }

                //após pegar todas as informações redirecionar para a home do seu sistema
                header("location: home.php");
                die; 
            }
              //se a senha estiver incorreta retorna verificar igual a 1
            else{
              header('Location:login.php?verificar=1');
            }
           

        } //se não existir o usuário retorna verificar igual a 2
        else{
            header('Location: index.php?verificar=2');
        }
    }


?>