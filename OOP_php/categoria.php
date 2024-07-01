<?php
    class categoria 
 {
        private $nome_categoria;
        private $descricao;
        private $figura;
 
    public function __construct($nome_categoria, $descricao, $figura)
    {
        $this->nome_categoria = $nome_categoria;
        $this->descricao = $descricao; 
        $this->figura = $figura; 
        
    }

     function get_name($nome)
     {
        $this->nome = $nome;
     } 
}

?>