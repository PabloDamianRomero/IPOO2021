<?php
class CuentaCorriente extends Cuenta{
    private $montoMaximo;

    public function __construct($pNum, $pSaldo, $pCliente, $pMontoMax){
        parent::__construct($pNum, $pSaldo, $pCliente);
        $this->montoMaximo = $pMontoMax;
    }

    /**
     * Get the value of montoMaximo
     */ 
    public function getMontoMaximo()
    {
        return $this->montoMaximo;
    }

    /**
     * Set the value of montoMaximo
     *
     */ 
    public function setMontoMaximo($montoMaximo)
    {
        $this->montoMaximo = $montoMaximo;

    }

    public function __toString(){
        $cadena = "";
        $cadena .= parent::__toString();
        $cadena .= "\nMonto Máximo: ".$this->getMontoMaximo();
        return $cadena;
    }
}