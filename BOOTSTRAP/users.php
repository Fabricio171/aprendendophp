<?php 
        require_once 'connect.php';
        require_once 'header.php';

        echo "<div class='container'>";

        if (isset($_POST['delete']))    // ele vai deletar o registro que vc deseja 
        {
            $sql = "DELETE FROM users WHERE user-id=".$_POST['userid'];

            if ($con->query($sql) === true)
            {
                echo "<div class='alert aler-seccess'>Successfully delete user </div>";
            }
        }
      $sql =  "SELECT * FROM users";
      $result = $con->query($sql);

      if ($result->num_rows > 0)
      {
        ?> <!-- POSIVEL MUITO ERRRO NESTA LINHA!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
           <h2>List of all Users</h2>
            <table class="table table-bordered table-striped">
                <tr>
                    <td>Firstname</td>
                    <td>Lastname</td>
                    <td>Address</td>
                    <td>Contact</td>
                    <td width="70px">Delete</td>
                    <td width="70px">Edit</td>
                </tr>    
       <?php
       
       
       