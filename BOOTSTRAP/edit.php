<?php
    require_once 'connect.php';
    require_once 'header.php';
?>  
    <div class="container">
         <?php
            if (isset($_POST['update'])) // atualizar os dados do banco
            {
                if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['address']) || empty($_POST['contact']))
                {   
                    echo "Please fillout all required fields";                  
                }
                else
                {
                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $address = $_POST['address'];
                    $contact = $_POST['contact'];

                    $sql = "UPDATE users SET firstname='{$firstname}', lastname = '{$lastname}', address = '{$address}', 
                            contact = '{$contact}' WHERE user_id =" .$_POST['userid'];  
                              
                          if ($con->query($sql) === TRUE)
                          {
                            echo "<div class='alert alert-success'> Successfully updated user </div>";   
                          }
                          else 
                          {
                            echo "<div class='alert alert-danger'> Error: There was an error while updating user info </div>";
                          }    
                }
            } // fechamento 
            
       $id = isset($_GET['id']) ? (int)$_GET['id'] :0;  // insercao do dos dados     

$sql = "SELECT * FROM users WHERE user_id={$id}";
$result = $con->query($sql);

if ($result->num_rows <1)
{
    header('location: index.php'); 
    exit;
}

$row = $result->fetch_assoc(); 
?>

<div class="row">
  <div class="col-md-6 col-md-offset-3"> <!--um formulario simples-->
      <div class="box">

        <h3><i class="glyphicon glyphicon-plus"></i>&nbsp;MODIFY User</h3> <!--modificacao de usuario!-->

           <form action="" method="post">
           <input type="hidden" value="<?php echo $row['user_id'];?>" name="userid">  <!-- atualizar os registros -->

                <label for="firstname">Firstname</label>
                   <input type="text" id="firstname" name="firstname" value="<?php echo $row['firstname'];?>" class="form-control">
                        <br>
                <label for="lastname">Lastname</label>
                   <input type="text" id="lastname" name="lastname" value="<?php echo $row['lastname'];?>" class="form-control"> 
                        <br>
                <label for="address">Address</label>
                  <textarea row="4" name="address" class="form-control"><?php echo $row['address'];?></textarea>     
                        <br>
                <label for="contact"> Contact</label>
                   <input type="text" id="contact" name="contact" value="<?php echo $row['contact'];?>" class="form-control">       
                        <br>
                    <input type="submit" name="update" class="btn btn-success" value="Update">    
                                               
           </form>
        </div>    
 </div>
</div>
</div>

<?php 
    require_once 'footer.php';  // ele chama o footer.php (o rodapé)
    




