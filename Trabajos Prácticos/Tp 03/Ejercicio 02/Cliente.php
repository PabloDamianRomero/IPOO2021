<?php
class Cliente extends Persona{
    private $numCliente;

    public function __construct($num, $nom, $ape, $numC){
        parent::__construct($num, $nom, $ape);
        $this->numCliente = $numC;
    }

    /**
     * Get the value of numCliente
     */ 
    public function getNumCliente()
    {
        return $this->numCliente;
    }

    /**
     * Set the value of numCliente
     *
     */ 
    public function setNumCliente($numCliente)
    {
        $this->numCliente = $numCliente;
    }

    public function __toString(){
        $cadena = "";
        $cadena .= parent::__toString();
        $cadena .= "\nNúmero de cliente: ".$this->getNumCliente();
        return $cadena;
    }
}