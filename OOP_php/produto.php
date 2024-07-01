<?php
    class produto 
    {
        
        private $nome_prod;
        private $id_for;
        private $id_cate;
        private $quant_unit;
        private $preco_unit;
        private $unid_estoque;
        private $unid_ped;
        private $nivel_estoque;
        private $descontinuado;

    public function __construct($nome_prod, $id_for, $id_cate, $quant_unit, $preco_unit, $unid_estoque, $unid_ped, $nivel_estoque, $descontinuado)
    {
        $this->nome_prod = $nome_prod;
        $this->id_for = $id_for; 
        $this->id_cate = $id_cate; 
        $this->quant_unit = $quant_unit; 
        $this->preco_unit = $preco_unit; 
        $this->unid_estoque = $unid_estoque; 
        $this->unid_ped = $unid_ped; 
        $this->nivel_estoque = $nivel_estoque; 
        $this->descontinuado = $descontinuado; 
    }

     function get_name($nome)
     {
        $this->nome = $nome;
     } 

    }

?>