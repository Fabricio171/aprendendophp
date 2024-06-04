<?php
    include_once 'functions.php';
    sec_session_start();

        //apagar todos os valores da sessao
       $_session = array();
       //tras os parametros da sessao
       $params = session_get_cookie_params();
       //apagar os cookie em uso
       setcookie(session_name(),
        '',time()-42000,
       $params["path"],
       $params["domain"],
       $params["secure"],
       $params["httponly"]);

       // destroi a sessao

        session_destroy();
        header('location: ../index.php');
       
       

       
       