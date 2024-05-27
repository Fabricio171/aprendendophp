<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD com PHP, de forna simples e fácil</title>
</head>
<body>
 <form action="<?=$_SERVER["PHP_SELF"]?>"method="POST">
        <center>
        Id_produto:<br/>
        <input type="text" name="id_produto"placeholder="Qual produto cadastrar"><br><br>
        Nome_produto:<br/>
        <input type="text" name="nome_produto"placeholder="Qual nome do produto?"><br><br>
        Unidade_de_medida:<br/>
        <input type="text" name="unidade_de_medida"placeholder="Qual a media do produto?"><br><br>
        Marca_produto:<br>
        <input type="text" name="Marca_produto"placeholder="Qual a marca do produto"><br><br>
        Imposto:<br>
        <input type="text" name="Imposto"placeholder="Qual imposto do produto">
        <br><br>
        <input type="hidden" value="-1" name="id">
        <button type="submit">Cadastrar</button>
        </form>    
    </center>            
    ?><br><br>
        <center>
         <table width="1000px"border="1"cellspacing="1">
         <tr>
            <td><strong>#</strong></td>
             <td><strong>Id_produto</strong></td>
             <td><strong>Nome_produto</strong></td>
             <td><strong>unidade_de_medida</strong></td>
             <td><strong>Marca_produto</strong></td>
             <td><strong>Imposto</strong></td>
             <td><strong>#</strong></td>
         </tr>
         </center>
         <?

 


        
       
        
       
        
