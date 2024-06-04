<?php
    include_once 'db_connect.php';
    include_once 'functions.php';

    sec_session_start();  //sessao personalizada

    if (isset($_POST['email'],
        $_POST['p'])) 
        {
            $email = $_POST['email'];
            $password = $_POST['p'];

          if (login($email, $password, $mysqli)== true)
          {
            // login sucesso
                header('location: ../protected_page.php');
          }  
          else 
          {
            //falha no login
                header('location: ../index.php?erro=1');
          }
        }
        else
        {
            echo 'requisicao invalida';
        }
        