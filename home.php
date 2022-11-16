<?php
header("Content-type: text/html; charset=utf-8");

/* inicia a sessão */
session_start();

//if que verifica se o usuario está logado, se não estiver destroi a sessão e redireciona para o login
if (!isset($_SESSION['Acessar'])) {
    header("Location: login.php");
    session_destroy();
}

?>
<!DOCTYPE html>
<html>
  <head>
         
  </head>
<body>
    
          
        <!-- Page Header-->
      <header> 
        <h1>INFORMAÇÕES USUARIO</h1>
      </header>

      <!-- Se a sessão estiver ativada pega os dados da sessão que advem da nossa controller -->
      <h2>Nome: <?=$_SESSION['nome']?></h2>
      <h3>Mora em: <?=$_SESSION['cidade']?></h3>
      <h4>Usuário está: 
          <?php
            if($_SESSION['sessao'] == 1){
              echo "logado";
            }else{
              echo "offline há um problema aqui! rsrs"
            }
          ?>
      </h4>
  </body>
</html>