<?php
header("Content-type: text/html; charset=utf-8");

/* define o limitador de cache para 'private' */
session_cache_limiter('private');

//cache de 10 minutos
session_cache_expire(60);
 
/* inicia a sessão */
session_start();
 
if (!empty($_POST['cpf']) && !empty($_POST['senha'])) {
    require "usuario_controller.php";
}

 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Teste PDO</title>
  </head>
  <body>
            <?php if( isset($_GET['verificar']) && $_GET['verificar'] == 1) {?>
                <div class="alert alert-warning" role="alert">
                  <center><h5>Esse usuário não está cadastrado!</h5></center>
                      <?php
                    echo "<meta HTTP-EQUIV='refresh' CONTENT='3;URL=login.php'>";
                  ?>	
              </div>
            <?php } ?>  
            <?php if( isset($_GET['verificar']) && $_GET['verificar'] == 2) {?>
                <div class="alert alert-warning" role="alert">
                  <center><h5>Senha Inválida!</h5></center>
                      <?php
                    echo "<meta HTTP-EQUIV='refresh' CONTENT='3;URL=login.php'>";
                  ?>	
              </div>
              <?php } ?> 
              
            

  <form action="login.php?acao=acessar" method="POST"> 
    <div>
      <label><strong>Usuário:</strong></label>
      <input name="user" id="user" type="text" required onkeyup="this.value = Trim( this.value )">
    </div>
    <div>
      <label><strong>Senha:</strong></label>
      <input name="senha" placeholder="Senha" type="password" required>
    </div>

    <div>
      <p align="justify" style="font-size:18px;color:darkgoldenrod">
        <strong> Confirme que não é um robô -> </strong> 
        <input id="concordar" name="concordar" type="checkbox" required value="1" style="height: 14px; width: 14px;">
      </p>
    </div> <!--Submit-->
             
  </form>
      
      
        <!-- Main File-->
      <script src="js/front.js"></script>
        <script>
          $("#concordar").on("click", function () {
              ($(this).is(':checked')) ? $("#btn").prop("disabled", false): $("#btn").prop("disabled", true);
          });

            function Trim(str){
              return str.replace(/^\s+|\s+$/g,"");
            }

            document.getElementById("user").onkeypress = function(e) {
              var chr = String.fromCharCode(e.which);
              if ("1234567890qwertyuioplkjhgfdsazxcvbnm".indexOf(chr) < 0)
                return false;
            };
        </script>
  </body>
 
</html>