<?php
    class pedido 
    {
        
        private $id_cli;
        private $id_func; //funcionario
        private $data_pedido;
        private $data_entrega;
        private $data_envio;
        private $frete;
        private $nome_destinatatio;
        private $endereco_destinatatio;
        private $cidade_destino;
        private $cep_destino;
        private $pais_destino;

        //metodo
        public function __construct($id_cli, $id_func, $data_pedido, $data_entrega, $data_envio, $frete, $nome_destinatatio, $endereco_destinatatio, $cidade_destino, $cep_destino, $pais_destino )
        {
            $this->id_cli = $id_cli;
            $this->id_func = $id_func; 
            $this->data_pedido = $data_pedido; 
            $this->data_entrega = $data_entrega; 
            $this->data_envio = $data_envio; 
            $this->frete = $frete; 
            $this->nome_destinatatio = $nome_destinatatio;
            $this->endereco_destinatatio = $endereco_destinatatio;
            $this->cidade_destino   = $cidade_destino;
            $this->cep_destino = $cep_destino;
            $this->pais_destino = $pais_destino;
                 
        }
        function  


    }


?>