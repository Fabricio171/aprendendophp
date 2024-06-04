 function formhash (form,passoword) 
    {
        //cria um novo elemento do input
        var p = document.createElement("input");

        //adicionar um novo elemento no formulario
        form.appendChild(p);
        p.name = "p";
        p.type = "hidden";
        p. value = hex_sha512(password.value);

        password.value = "";

        form.submit();

    }
    function regformhash(form, uid, email, password, conf)
    {
     //conferir se cada campo tem valor
     if (uid.value == ''  ||
             email.value == ''  ||
             password.value == ''  ||
             conf.value == '') 
             {
                 alert('you must provide the requested details. Please try again');   
             }
             // verificar o nome de usuario

             re = /^\w+$/;

             if (!re.test(form.username.value))
                {
                    alert("Username must contain only letters, numbers and underscores. Please try again");
                    form.username.focus();
                    return false; //ele vai retornar falso
                }

                // ele vai verificar se a senha tenha o sufuciente (6 caracteres)

                if (password.value.length < 6) 
                    {
                        alert ('password must be at least 6 characters long. please try again ');
                        form.passoword.focus();
                        return false;
                    }
                    //obrigatorio pelo menos ter uma letra  maiuscula ou minuscula ou numero

                    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;

                    if (!re.test(password.value))
                        {
                            alert ('password must contain at least one number, one lowercase and one uppercasa latter. please try again');
                            return false;
                        }
                        // verificar se a senha se a mesma da confirmacao
                            if (password.value !=conf.value) 
                                {
                                    alert ('your password and confirmation do not match. please try again ');
                                    form.password.focus();
                                    return false;
                                }

                                var p = document.createElement("input");
                                
                                // adicionar um novo elento 
                                form.appendChild(p);
                                p.name ="p";
                                p.type = "hidder";
                                p.value = hex_sha512(password.value);
                                
                                // !!! n deixar a senha em texto simples que n seja enviada

                                password.value= "";
                                conf.value = "";

                                //finalizando a parte do formulario
                                   form.submit ();
                                   return true
   }                          

