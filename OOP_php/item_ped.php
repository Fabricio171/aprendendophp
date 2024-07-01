<?php
    class item_ped 
    {
        private $id_ped;
        private $id_prod;
        private $preco_unit;
        private $quant;
        private $desconto
    //metodos 
    public function __construct($id_ped, $id_prod, $preco_unit, $quant, $desconto)
    {
        $this->id_ped = $id_ped;
        $this->id_prod = $id_prod; 
        $this->preco_unit = $preco_unit; 
        $this->quant = $quant; 
        $this->desconto = $desconto; 
    }

     function get_name($nome)
     {
        $this->nome = $nome;
     } 
    }

?>