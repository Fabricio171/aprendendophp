<?php
  class cliente 
  {
      
    private $nome;
    private $endereco;
    private $cidade;
    private $cep;
    private $uf;
    private $pais;
    private $telefone;
    private $fax;

    //metodos 
     public function __construct($nome, $endereco, $cidade, $cep, $uf, $pais, $telefone)
    {
        $this->nome = $nome;
        $this->endereco = $endereco; 
        $this->cidade = $cidade; 
        $this->cep = $cep; 
        $this->uf = $uf; 
        $this->pais = $pais; 
        $this->telefone = $telefone;  
    }
        function set_nome($nome)
        {
            $this->nome = $nome;
        }

            function get_nome()
            {
                return $this->nome;
            }

                function set_telefone($telefone)
                {
                    $this->telefone = $telefone;
                }

                    function get_telefone()
                    {
                        return $this->telefone;
                    }
                        function set_cidade($cidade)
                        {
                            $this->cidade = $cidade; 
                        }
                            function get_cidade()
                            {
                                return $this 
                            }
    
                        function set_endereco($endereco,$cep, $uf, $pais)
                            {          
                                    $this->endereco = $endereco; 
                                 
                                    $this->cep = $cep; 
                                    $this->uf = $uf; 
                                    $this->pais = $pais;    
                            }

     





    }

?>