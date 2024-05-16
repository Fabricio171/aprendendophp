<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastros</title>
</head>
<body>
        <form action="<?=$_SERVER["PHP_SELF"]?>"method="POST">
             <label for="nome">Nome: </label><br>
                <input type="text" id="nome" placeholder="Qual seu nome?"><br>
             
             <label for="email">E-mail: </label><br>
                <input type="email" id="email" placeholder="Qual seu e-mail?"><br>
                
             <label for="cidade">Cidade: </label><br>
                <input type="text" id="cidade" placeholder="Qual sua cidade?"><br>

             <label for="uf">UF: </label><br>
                 <input type="text" id="uf" size="2" placeholder="UF"><br>
                 
                 <input type="hidden" value="-1" name="id" >
                    <button type="submit">Cadastrar</button>

        </form>

<?php
      $obj_mysqli = new mysqli("127.0.0.1","seu_usuario","sua_senha","tutocrudphp");

      if($obj_mysqli->connect_errno)
         {
            echo"Ocorreu um erro na conexão com o banco de dados.";
            exit;
         }

   mysqli_set_charset($obj_mysqli,'utf8');

     if( isset($_POST["nome"]) 
      && isset($_POST["email"])
      && isset($_POST["cidade"])
      && isset($_POST["uf"]))    {

                        if(empty($_POST["nome"])) {

                           $erro = "Campo nome obrigatório";
                        }                            
                        elseif (empty($_POST["email"])) {

                              $erro = "Campo e-mail obrigatório";
                        }  
                           else{     
                              $nome   = $_POST["nome"];
                              $email  = $_POST["email"];
                              $cidade = $_POST["cidade"];
                              $uf     = $_POST["uf"];

                              $stmt = $obj_mysqli->prepare("INSERT INTO `cliente` (`nome`,`email`,`cidade`,`uf`) VALUES (?,?,?,?)");
                              $stmt->bind_param('ssss',$nome,$email,$cidade,$uf);

                              if (!$stmt->execute()){
                                 $erro = $stmt->error;
                                 }
                              
                              else {
                                 $sucesso = "Dados cadastrados com sucesso!";
                                 }

                           }             

               
            }

?>    
    
</body>
</html>