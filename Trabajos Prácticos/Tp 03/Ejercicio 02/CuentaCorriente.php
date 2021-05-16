<?php
class CuentaCorriente extends Cuenta
{
    private $montoMaximo;

    public function __construct($pNum, $pSaldo, $pCliente, $pMontoMax)
    {
        parent::__construct($pNum, $pSaldo, $pCliente);
        $this->montoMaximo = $pMontoMax;
    }

    public function getMontoMaximo()
    {
        return $this->montoMaximo;
    }

    public function setMontoMaximo($montoMaximo)
    {
        $this->montoMaximo = $montoMaximo;
    }

    public function __toString()
    {
        $cadena = "";
        $cadena .= parent::__toString();
        $cadena .= "\nDescubierto: " . $this->getMontoMaximo();
        return $cadena;
    }

    public function realizarRetiro($monto)
    {
        $descubierto = $this->getMontoMaximo();
        $saldo = $this->getSaldo();
        $saldo += $descubierto;
        $exito = false;
        if ($saldo > $monto) {
            $retiro = $saldo - $monto;
            $this->setSaldo($retiro);
            $exito = true;
        }
        return $exito;
    }
}
