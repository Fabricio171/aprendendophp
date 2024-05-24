
<?php
$obj_mysqli = new mysqli("127.0.0.1", "root", "", "tutocrudphp");

if($obj_mysqli->connect_errno)
{
    echo "Ocorreu um erro na conexâo com o banco de dados.";
    exit;
}

mysqli_set_charset($obj_mysqli, 'utf8');

$id = -1;
$nome = "";
$descricao = "";
$unid = "";
$marca = "";

if(isset($_POST["nome"]) && isset($_POST["descricao"]) && isset($_POST["unid"]) && isset($_POST["marca"]))
{
    if(empty($_POST["nome"]))
        $erro = "Campo de nome obrigatório";
    else
        if(empty($_POST["descricao"]))
            $erro = "Campo de descrição obrigatório";
    else
        if(empty($_POST["unid"]))
            $erro = "Campo de unidade obrigatório";
    else
        if(empty($_POST["marca"]))
            $erro = "Campo da marca obrigatório";
    else
    {
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];
        $unid = $_POST["unid"];
        $marca = $_POST["marca"];

        if($id == -1)
        {
            $stmt = $obj_mysqli->prepare("INSERT INTO `produto` (`nome`, `descricao`, `unid`, `marca`) VALUES (?,?,?,?)");
            $stmt->bind_param('ssss', $nome, $descricao, $unid, $marca);

            if(!$stmt->execute())
            {
                $erro = $stmt->error;   
            }
            else
            {
                header("location:produto.php");
                exit;
            }
        }

        else
        if(is_numeric($id) && $id >= 1)
        {
            $stmt = $obj_mysqli->prepare("UPDATE `produto` SET `nome`=?, `descricao`=?, `unid`=?, `marca`=? WHERE id = ? ");
            $stmt->bind_param('ssssi',$nome, $descricao, $unid, $marca, $id);

            if(!$stmt->execute())
            {
                $erro = $stmt->error;
            }
            else
            {
                header("location:produto.php");
                exit;
            }
        }
        else
        {
            $erro = "Número inválido";
        }
    }
}
else
    if(isset($_GET["id"]) && is_numeric($_GET["id"]))
    {
        $id = (int)$_GET["id"];

        if(isset($_GET["del"]))
        {
            $stmt = $obj_mysqli->prepare("DELETE FROM `produto` WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();

            header("location:produto.php");
            exit;
        }
        else
        {
            $stmt = $obj_mysqli->prepare("SELECT * FROM `produto` WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $aux_query = $result->fetch_assoc();

            $id = $aux_query["Id"];
            $nome = $aux_query["Nome"];
            $descricao = $aux_query["Descricao"];
            $unid = $aux_query["Unid"];
            $marca = $aux_query["Marca"];

            $stmt->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>
</head>
<body>
<?php
        if(isset($erro))
        echo '<div style="color:#F00">'.$erro.'</div><br/><br/>';
?>

    <form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
        <fieldset>
            <legend><h1>Produto</h1></legend>

            <label for="nome">Digite o Nome do produto:</label><br>
            <input type="text" name="nome" id="nome" value="<?=$nome?>"><br><br>
            <hr>

            <label for="descr">Digite a descrição do produto:</label><br>
            <input type="text" name="descricao" id="descr" value="<?=$descricao?>"><br><br>
            <hr>

            <label for="unid">Digite o tipo de unidade</label><br>
                <h3>litros</h3>
            <input type="radio" id="unid" name="fav_language" value="<?=$unid?>">
                <label for="unid">ML</label>
            <input type="radio" id="unid" name="fav_language" value="<?=$unid?>">
                <label for="unid">L</label>

                <h3>peso</h3>
            <input type="radio" id="unid" name="fav_language" value="<?=$unid?>">
                <label for="unid">MG</label>
            <input type="radio" id="unid" name="fav_language" value="<?=$unid?>">
                <label for="unid">G</label>
            <input type="radio" id="unid" name="fav_language" value="<?=$unid?>">
                <label for="unid">KG</label>
                <input type="radio" id="unid" name="fav_language" value="<?=$unid?>">
                <label for="unid">T</label>       
           
            <hr>

            <label for="marca">Digite a marca do produto:</label><br>
            <input type="text" name="marca" id="marca" value="<?=$marca?>"><br><br>
            <hr>

            <input type="hidden" value="<?=$id?>" name="id">
            <button type="submit"><?=($id==-1)?"Enviar":"Salvar"?></button>
        </fieldset>
    </form>

    <br>
    <br>
    <table width="800px" border="2" cellspacing="2">
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Unid</th>
            <th>Marca</th>
            <th>#</th>
        </tr>

<?php
    $result = $obj_mysqli->query("SELECT * FROM `produto`");
    while ($aux_query = $result->fetch_assoc()) 
    {
        echo'<tr>';
        echo'  <td>'.$aux_query["Id"].'</td>';
        echo'  <td>'.$aux_query["Nome"].'</td>';
        echo'  <td>'.$aux_query["Descricao"].'</td>';
        echo'  <td>'.$aux_query["Unid"].'</td>';
        echo'  <td>'.$aux_query["Marca"].'</td>';
        echo'  <td><a href="'.$_SERVER["PHP_SELF"].'?id='.$aux_query["Id"].'">Editar</a></td>';
        echo'  <td><a href="'.$_SERVER["PHP_SELF"].'?id='.$aux_query["Id"].'&del=true">Excluir</a></td>';
        echo'</tr>';
    }
?>

    </table>
</body>
</html>

