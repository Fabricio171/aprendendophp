<?php
    class fornecedor  
    {
        private $nome_empresa;
        private $nome_contato;
        private $cargo_contato;
        private $endereco;
        private $cidade;
        private $uf; 
        private $cep;
        private $pais;
        private $telefone;
       
        public function __construct($nome_empresa, $nome_contato, $cargo_contato, $endereco, $cidade, $uf, $cep, $pais, $telefone)
    {
        $this->nome_empresa = $nome_empresa;
        $this->nome_contato = $nome_contato; 
        $this->cargo_contato = $cargo_contato; 
        $this->endereco = $endereco; 
        $this->cidade = $cidade; 
        $this->uf = $uf; 
        $this->cep = $cep; 
        $this->pais = $pais; 
        $this->telefone = $telefone; 
    }

     function get_name($nome)
     {
        $this->nome = $nome;
     } 

    }

?>