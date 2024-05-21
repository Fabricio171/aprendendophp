
<?php
    $obj_mysqli = new mysqli("127.0.0.1","root","","tutocrudphp");

    if($obj_mysqli->connect_errno)
        {
            echo "A um erro na conexão";
            exit;
        }

     mysqli_set_charset($obj_mysqli,'utf8');
     
     $id = -1;
     $nome = "";
     $desc = "";
     $unid = "";
     $marca = "";

     if(isset($_POST["nome"])
        && isset($_POST["desc"])
        && isset($_POST["unid"])
        && isset($_POST["marca"]))
        {
            if(empty($_POST["nome"]))
            {
                $erro = "Campo nome do produto obrigatorio";
            }
               elseif(empty($_POST["desc"]))
               {
                $erro = "Campo descricao obrigatorio";
               } 
                elseif(empty($_POST["unid"]))
                {
                    $erro = "Campo obrigatorio";
                }
                    elseif(empty($_POST["marca"]))
                    {
                        $erro = "campo Marca obrigatorio";
                    }
         
    else
    {
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $desc = $_POST["desc"];
        $unid = $_POST["unid"];
        $marca = $_POST["marca"];

        if($id == -1)
        {
            $stmt = $obj_mysqli->prepare("INSERT INTO `pedido`(`nome`,`desc`,`unid`,`marca`) value (?,?,?,?)");
            $stmt->bind_param($nome, $desc, $unid, $marca);
             
               if(!$stmt->execute())
               {
                $erro = $stmt->$erro;
               }
                else
                {
                    header("location:produto.php");
                    exit;
                } 
            }      
       elseif (is_numeric($id) && $id >=1)
       {
            $stmt = $obj_mysqli->prepare("UPDATE `produto` SET `nome`=?, `desc`=?, `unid`=?, `marca`=? WHERE id = ?");
            $stmt->bind_param($nome, $desc, $unid, $marca, $id);
            
            if(!$stmt->execute())
                {
                    $erro = $stmt->$erro;
                }
               else
               {
                header("location:produto.php");
                exit;
               } 
       }
       else
       {
         $erro = "Numero invalido";
       } 
    }   
}
  




?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>produto</title>
</head>
<body>
       <form action="<?=$_server["php_self"]?>" method="post">
          
       <fieldset> 
            <legend><h1>Produto</h1></legend>

            <label for="nome">Digite o nome do produto:</label><br>
               <input type="text" name="nome" id="nome"><br>
                        <br>
                        <hr>
                  <label for="desc">Digite a descricao do produto:</label><br>
                    <input type="text" name="desc" id="desc"><br>
                        <br>
                        <hr>
                   <label for="unid">Digite tipo de unidade:</label><br>
                     <input type="text" name="unid" id="unid" placeholder="mg,ml,kg..."><br> 
                        <br>
                        <hr>
                    <label for="marca">Digite a marca do produto:</label><br>
                        <input type="text" name="marca" id="marca"> <br>
                            <br>
                           <input type="hidden" value="<?=$Id?>" name="Id"> 

                           <button type="submit"><?=($id==-1)?"Cadastrar":"Salvar"?></button>      
                            
      </fieldset>              
       </form>

       <table width="800px" border="2" cellspacing="2">
            <tr>
                <td>#</td>
                <td>Nome</td>
                <td>Descrição</td>
                <td>tipo de unidade</td>
                <td>Marca</td>
                <td>#</td>
            </tr>
       </table>
        
    
</body>
</html>


