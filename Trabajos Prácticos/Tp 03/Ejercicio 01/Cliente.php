<?php
include 'Persona.php';
class Cliente extends Persona{
    private $nroCliente;

    public function __construct($pDni, $pNom, $pApe, $pNroCliente){
        parent:: __construct($pDni, $pNom, $pApe);
        $this->nroCliente = $pNroCliente;
    }

    
    public function getNroCliente()
    {
        return $this->nroCliente;
    }


    public function setNroCliente($nroCliente)
    {
        $this->nroCliente = $nroCliente;
    }

    public function __toString(){
        $cadena = "";
        $cadena .= parent::__toString();
        $cadena .= "\nNro Cliente: ".$this->getNroCliente();
        return $cadena;
    }
}