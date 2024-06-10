<?php
    require_once 'connect.php';
    require_once 'header.php';
?>

 <div class="container">
    <?php   
        if (isset($_POST['addnew'])) 
        {
            if (empty($_POST['firsname']) || empty($_POST['lastname']) || empty($_POST['address']) || empty($_POST['contact']))
            {
                echo "Please fillout all required fields";             
            }
            else 
            {
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $address = $_POST['address'];
                $contact = $_POST['contact'];

                $sql = "INSERT INTO users (firstname, lastname, address, contact) VALUE ('$firsname', '$lastname', '$address', '$contact')";
                    if ($con->query($sql) == true)
                    {
                        echo "<div class='alert alert-success'> Sucessfully added new user </div>";
                    }
                    else
                    {
                        echo "<div class='alert alert-danger> Error: There was an error while addid";
                    }
            }
        }
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
         <div class="box">
            <h3><i class="glyphicon glyphicon-plus"></i>&nbsp;Add New User</h3>

                 <form action="" method="post">  <!-- formulario       -->

                    <label for="firstname">Firstname</label>
                        <input type="text" name="firstname" id="firstname" class="form-control"> 
                                <br>
                    <label for="lastname">Lastname</label>
                        <input type="text" name="lastname" id="lastname" class="form-control">
                                <br>
                    <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control"></textarea>
                                <br>
                    <label for="contact">Contact</label>
                        <input type="text" name="contact" id="contact" class="form-cotrol">
                                <br>
                                <br>
                        <input type="submit" name="addnew" class="btn btn-sucess" value="Add New">
                 </form>
         </div>
    </div>
</div>
</div>  

<?php

require_once 'footer.php';



                 

