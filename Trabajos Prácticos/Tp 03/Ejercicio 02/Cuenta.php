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

    public function getNumCuenta()
    {
        return $this->numCuenta;
    }

    public function getSaldo()
    {
        return $this->saldo;
    }

    public function getObjCliente()
    {
        return $this->objCliente;
    }

    public function setNumCuenta($numCuenta)
    {
        $this->numCuenta = $numCuenta;
    }

    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;
    }

    public function setObjCliente($pObjCliente)
    {
        $this->objCliente = $pObjCliente;
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
        $exito = false;
        $deposito = $this->getSaldo() + $monto;
        if($deposito > $this->getSaldo()){
            $exito = true;
        }
        $this->setSaldo($deposito);
        return $exito;
    }

    public function realizarRetiro($monto){
        $exito = false;
        $saldo = $this->getSaldo();
        if($saldo > $monto){
            $retiro = $saldo - $monto;
            $this->setSaldo($retiro);
            $exito = true;
        }
        return $exito;
    }
}
