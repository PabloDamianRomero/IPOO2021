<?php
class CajaAhorro extends Cuenta
{

    public function __construct($pNum, $pSaldo, $pCliente)
    {
        parent::__construct($pNum, $pSaldo, $pCliente);
    }

}
