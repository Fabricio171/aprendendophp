<?php
    include_once 'psl-config.php';

    function sec_session_start() 
    {
        $session_name = 'sec_session_id'; //nome personalizado na sessao
            $session = secure;
                // isso impede de o javascript acessa a identificacao da sessao
            $httponly = true ;
                // forca ele a usar apenas cookies
                if(ini_set('session.use_only_cookies',1) ===false){
                    header("location: ../error.php?err=could not initiante a safa session (ini_set)");
                    exit;
                }
                // ele atualiza os cookies 
                    $cookiesParams = session_get_cookie_params();
                        session_get_cookie_params($cookieParams["lifetime"],
                        $cookieParams["path"],
                        $cookieParams["domain"],
                        $secure,
                        $httponly);
                        //ele da um nome para a sessao. no codigo a cima
                       session_name ($session_name);
                       session_start(); //ele comeca a sessao em php
                       session_regenerate_id(); //ele recupera a sessoa e deleta a anterio
    }
    



?>