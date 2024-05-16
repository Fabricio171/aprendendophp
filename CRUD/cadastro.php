<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastros</title>
</head>
<body>
   <?php
         if(isset($erro)) {
         echo'<div style="color:#F00">'.$erro.'</div><br/><br/>';
         }
         elseif (isset($sucesso)) {
         echo'<div style="color:#00f">'.$sucesso.'</div><br/><br/>';
         }
?>
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
$result = $obj_mysqli->query("SELECT * FROM `cliente`");
while($aux_query = $result->fetch_assoc())
{
    echo' <tr>';
    echo' <td>'.$aux_query["Id"].'</td>';
    echo' <td>'.$aux_query["Nome"].'</td>';
    echo' <td>'.$aux_query["Email"].'</td>';
    echo' <td>'.$aux_query["Cidade"].'</td>';
    echo' <td>'.$aux_query["UF"].'</td>';
    echo' <td><a href="'.$_SERVER["PHP_SELF"].'?id='.$aux_query["Id"].'">Editar</a></td>';                 
    echo' </tr>';
    }

   if (isset($erro)){
       echo'<div style="color:#F00">'.$erro.'</div><br/><br/>';
   }
   elseif (isset($sucesso)){
      echo'<div style="color:#00f">'.$sucesso.'</div><br/><br/>';
   }

?>   
               <br><br>
         <table width="400px"border="0"cellspacing="0">
               <tr>
                  <td><strong>#</strong></td>
                  <td><strong>Nome</strong></td>
                  <td><strong>Email</strong></td>
                  <td><strong>Cidade</strong></td>
                  <td><strong>UF</strong></td>
                  <td><strong>#</strong></td>
               </tr>
                   
         </table>      
<?php
      $obj_mysqli = new mysqli("127.0.0.1","root","","tutocrudphp");

      if($obj_mysqli->connect_errno)
         {  
            echo"Ocorreu um erro na conexão com o banco de dados.";
            exit;
         }

   mysqli_set_charset($obj_mysqli,'utf8');

   $id     = -1;
   $nome   = "";
   $email  = "";
   $cidade = "";
   $uf     = "";

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
                              $id     = $_POST["id"];    
                              $nome   = $_POST["nome"];
                              $email  = $_POST["email"];
                              $cidade = $_POST["cidade"];
                              $uf     = $_POST["uf"];
                           
                           if($id == -1) {     

                              $stmt = $obj_mysqli->prepare("INSERT INTO `cliente` (`nome`,`email`,`cidade`,`uf`) VALUES (?,?,?,?)");
                              $stmt->bind_param('ssss',$nome,$email,$cidade,$uf);
                           }
                              if (!$stmt->execute()){
                                 $erro = $stmt->error;
                                 }
                              
                              else {
                                 header("Location:cadastro.php");
                                 exit;
                                 }                               
                           }  

                           elseif (is_numeric($id) && $id >= 1) {
                              $stmt = $obj_mysqli-> prepare ("UPDATE `cliente` SET `nome`=?, `email`=?, `cidade`=?, `uf`=?  $stmt->bind_param('ssssi',$nome,$email,$cidade,$uf,$id)");
                           if(!$stmt->execute()){
                              $erro = $stmt->error;
                           }  
                           else {
                              header("Location:cadastro.php");
                              exit;
                           }  
                        }         
                        else {
                           $erro = "Número inválido";
                        }
                     }
                  }
?>    
    
</body>
</html>