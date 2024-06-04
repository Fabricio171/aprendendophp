<?php 
    include_once'includes/register.inc.php';
    include_once'includes/functions.php';

    ?>

    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>secure login: registration form</title>
            <script type="text/JavaScript" src="js/sha512.js"></script>
            <script type="text/JavaScript" src="js/forms.js"></script>
              <link rel="stylesheet" href="styles/main.css">     
    </head>
    <body>
            <h1> register with us</h1>

            <?php   
                if(!empty($error_msg))
                {
                    echo $error_msg;
                }
              ?>
              <ul>
                <li>Os nomes de usuario devem conter apenas digitos, letras maiusculas e minuscula  e underliner("_")</li>
                <li>Emails devem seguir um formato valido para email</li>
                <li>As senhas devem ter no minimo 6 caracteres</li>
                <li>As senhas devem conter
              <ul>
                <li>pelo menos uma letra maiusculas (A..Z)</li>
                <li>Pelo menos uma letra minuscula (a..z)</li>
                <li>Pelo menos um numero (0..9)</li>
              </ul>
                </li>
                <li>Sua senha deve conferir exatamente</li>
              </ul>
              
              <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method= "post" name="registration_form">
                  <label for="username">Username:</label><br>
                    <input type="text" name="username" id="username">
                          <br>
                  <label for="Email">Email:</label><br> 
                    <input type="text" name="email" id="email"><br>
                          <br>
                  <label for="password">Password:</label><br>
                    <input type="password" name="password" id="password">
                          <br>
                   <label for="confirm_passworde">Confirm Passworde:</label><br>
                    <input type="password" name="confirmpwd" id="confirmpwd">
                          <br>  
                   <input type="button" value="Register" onclick="return regformhash(this.form,
                                                                                      this.form.username,
                                                                                      this.form.email,
                                                                                      this.form.password,
                                                                                      this.form.confirmpwd);">       
                          
              </form>
              <p>return to the <a href="index.php">login page</a></p>   
                
    </body>
    </html>
