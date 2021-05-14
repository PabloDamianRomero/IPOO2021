<?php
class Cuenta{
    private $numCuenta;
    private $saldo;
    private $objCliente;

    public function __construct($pNum, $pSaldo, $pCliente){
        $this->numCuenta = $pNum;
        $this->saldo = $pSaldo;
        $this->objCliente = $pCliente;
    }

    /**
     * Get the value of numCuenta
     */ 
    public function getNumCuenta()
    {
        return $this->numCuenta;
    }

    /**
     * Set the value of numCuenta
     *
     */ 
    public function setNumCuenta($numCuenta)
    {
        $this->numCuenta = $numCuenta;
    }

    /**
     * Get the value of saldo
     */ 
    public function getSaldo()
    {
        return $this->saldo;
    }

    /**
     * Set the value of saldo
     *
     */ 
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;
    }

    /**
     * Get the value of objCliente
     */ 
    public function getObjCliente()
    {
        return $this->objCliente;
    }

    /**
     * Set the value of objCliente
     *
     */ 
    public function setObjCliente($objCliente)
    {
        $this->objCliente = $objCliente;

    }

    public function __toString(){
        $cadena = "";
        $cadena .= "\nNúmero de cuenta: ".$this->getNumCuenta();
        $cadena .= "\nSaldo Actual: ".$this->getSaldo();
        $cadena .= "\nCLIENTE: ".$this->getObjCliente();
        return $cadena;
    }

    public function saldoCuenta(){
        $saldo = $this->getSaldo();
        return $saldo;
    }

    public function realizarDeposito($monto){
        $deposito = $this->getSaldo() + $monto;
        $this->setSaldo($deposito);
    }

    public function realizarRetiro($monto){
        $retiro = $this->getSaldo() - $monto;
        $this->setSaldo($retiro);
    }
}
