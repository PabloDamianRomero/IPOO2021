<?php
class CajaAhorro extends Cuenta
{

    public function __construct($pNum, $pSaldo, $pCliente)
    {
        parent::__construct($pNum, $pSaldo, $pCliente);
    }

    public function __toString()
    {
        $cadena = "";
        $cadena .= parent::__toString();
        return $cadena;
    }

    public function saldoCuenta()
    {
        parent::saldoCuenta();
    }

    public function realizarDeposito($monto)
    {
        parent::realizarDeposito($monto);
    }

    public function realizarRetiro($monto)
    {
        parent::realizarRetiro($monto);
    }
}
