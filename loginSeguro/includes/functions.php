<?php
    include_once 'psl-config.php';

    function sec_session_start() 
    {
        $session_name = 'sec_session_id'; //nome personalizado na sessao
        $secure = SECURE;
                // isso impede de o javascript acessa a identificacao da sessao
            $httponly = true ;
                // forca ele a usar apenas cookies
                if(ini_set('session.use_only_cookies',1) ===false){
                    header("location: ../error.php?err=could not initiante a safa session (ini_set)");
                    exit;
                }
                // ele atualiza os cookies 
                $cookieParams = session_get_cookie_params();
                session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
                        //ele da um nome para a sessao. no codigo a cima
                       session_name ($session_name);    
                       session_start(); //ele comeca a sessao em php
                       session_regenerate_id(); //ele recupera a sessoa e deleta a anterio
    }
    //deste posto para baixo, ele vai verificar se email e semha sao compativeis com que esta no banco de dados 
        function login($email, $password, $mysqli) 
        {
            if ($stmt = $mysqli->prepare("SELECT id, username, password, salt FROM members WHERE email = ? LIMIT 1"))  
            {
                         $stmt->bind_param('s', $email); 
                         $stmt->execute();     //executa a tarefa adiquirida
                         $stmt->store_result();

                         $stmt->bind_result($user_id, $username, $db_password, $salt);
                         $stmt->fetch();

                            $password = hash('sha512', $password . $salt);
                            if ($stmt->num_rows == 1) 
                            {
                                //se o usuario exister e tambem verifica se a conta esta bloqueada
                                 //porcausa so limite de tentativa 
                                   if (checkbrute ($user_id, $mysqli)== true)
                                   {
                                        // a conta ta bloquiada
                                        // ele vai enviar um email para o usuario, avisao que esta conta bloqueada
                                        return false (falso);
                                   } 
                                   else 
                                   {
                                        //ele confere se a senha é compativel com do banco 
                                        if ($db_password == $password)  //a senha ta correta
                                        {
                                                $user_browser = $_server['http_user_agent'];  //protecao xss 
                                                $user_id = preg_replace("/[^0-9]+/", "",$user_id);
                                                $_SESSION['user_id']= $user_id;
                                                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "",$username);
                                                        $_SESSION['username']= $username;
                                                        $_SESSION['login_string']= hash('sha512', $password .$user_browser);
                                                         //logado com sucesso
                                                            return true;
                                        }
                                        else 
                                        {
                                              // a senha n esta correta 
                                                //muitas tentativas
                                                $now = time();
                                                $mysqli->query("insert into login_attempts(user_id, time) values ('$user_id', '$now')");
                                                    return false ;   
                                        }
                                   }

                            } 
                            else 
                            {
                                //usuario nao existe
                                    return false;

                            }
            }
        }
        function checkbrute($user_id, $mysqli) 
        {
            //registra a hora atual
            $now = time();
                // ele vai contar todas as alternativa entre 2 horas
                $valid_attempts = $now - (2 * 60 * 60);

                if ($stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'"))
                    {
                        $stmt->bind_param('i', $user_id);
                        $stmt->execute();
                        $stmt->store_result();

                        if ($stmt->num_rows > 5)
                        {
                            return true;
                        }
                        else
                        {
                            return false;    
                        }
                    }
        }
     function login_check($mysqli) 
     {
         if (isset($_SESSION['user_id'], 
                   $_SESSION['username'], 
                   $_SESSION['login_string']))
                  {
                    
                    $user_id = $_SESSION['user_id'];
                    $login_string = $_SESSION['login_string'];
                    $username = $_SESSION['username'];

                    $user_browser = $_SERVER['HTTP_USER_AGENT'];

                    if ($stmt = $mysqli->prepare("SELECT 'password' FROM members WHERE id = ? LIMIT 1")) 
                     {
                        $stmt -> bind_param('i', $user_id);
                        $stmt -> execute();
                        $stmt -> store_result();
                         
                        if ($stmt -> num_rows ==1)
                        {
                            //caso o usuario exista
                            $stmt->bind_result($password);
                            $stmt->fetch();
                            $login_check = hash('sha512', $password . $user_browser);
                                 
                                if ($login_check == $login_string)
                                 {
                                      // logado!!!! 
                                          return true;
                                 } 
                                 else {
                                          // nao logado 
                                             return false;
                                      }
                        } 
                        else {
                                
                                return false;
                             }
                     } 
                     else {
                                           
                            header("Location: ../error.php?err=Database error: cannot prepare statement");
                            exit();
                          }
                  } 
                  else {
        
                            return false;
                       }
     }

     function esc_url($url)
     {
            if (''==$url) 
            {
                return $url;
            }
            $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

            $strip = array ('%0d', '%0a', '%0D', '%0A');
            $url = (string) $url;

            $count = 1 ;
            while ($count)
            {
                $url = str_replace($strip, '', $url, $count);
            }
            $url = str_replace(';//', '://', $url);
            $url = htmlentities($url);

            $url = str_replace('&amp;', '&#038;',$url);
            $url = str_replace("",'&#039;', $url);

            if ($url[0]!=='/')
            {
                return "";
            }
            else
            {
                return $url;
            }  
     }


