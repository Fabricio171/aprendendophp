<?php

   include_once 'db_connect.php';
   include_once 'psl-config.php';

    $error_msg="";

    if(isset($_POST['username'], $_POST ['email'], $_POST ['p']))
       {
        //ele vai limpar os dados passados
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            //quanto o email for invalido
            
            $erro_msg .='<p class="error"> o endereço de email digitado nao é valido</p>';
        }
        $password = filter_input(INPUT_POST,'p',FILTER_SANITIZE_STRING);

        if (strlen($password)!=128)
        {
            // a senha dever ter 128 caracteres
            $error_msg .='<p class="error"> Invalid password configuration.</p>'; 
        }
        // o nome seram verificados 
        // n deve ter problemas, ja que passaram sem problema sem ir contras as regras

        $prep_stmt = "select id from members where email = ? limit 1";
        $stmt = $mysqli -> prepare($prep_stmt);

        if ($stmt)
        {
            $stmt -> bind_param('s', $email);
            $stmt -> execute();
            $stmt -> store_result();

            if ($stmt -> num_rows == 1)
            {
                $error_msg .= '<p class="error"> um usuario com este email ja existe.</p>';
            }
         } 
         else{
                //o usuario com o email ja existe 
                $error_msg .= '<p class="error">Database error</p>';
            }
            //verificar que tipo de usuario esta tentando resgistrar
            if (empty($error_msg))    
            {   //crie um usuario salt
                $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

                // crie uma senha salt
                $password = hash('sha512', $password . $random_salt);

                // colocar um novo usuario no banco
                if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password, salt) VALUES (?, ?, ?, ?)")) 
                 {
                    $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt);
                     
                     //executa a tarefa pre-estabelecida
                     if (! $insert_stmt->execute())
                     {
                        header('Location: ../error.php?err=Registration failure: INSERT'); 
                     }
                 }  
                     header('Location: ./register_success.php');
            }
        }