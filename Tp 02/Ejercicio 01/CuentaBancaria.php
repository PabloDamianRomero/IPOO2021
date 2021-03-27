<?php

class CuentaBancaria
{

    private $numeroCuenta;
    private $persona;
    private $saldoActual;
    private $interesAnual;

    public function __construct($cuenta, $persona, $saldo, $interes)
    {
        $this->numeroCuenta = $cuenta;
        $this->persona = $persona;
        $this->saldoActual = $saldo;
        $this->interesAnual = $interes;
    }

    public function getNumeroCuenta()
    {
        return $this->numeroCuenta;
    }

    public function getPersona()
    {
        return $this->persona;
    }

    public function getSaldoActual()
    {
        return $this->saldoActual;
    }

    public function getInteresAnual()
    {
        return $this->interesAnual;
    }

    public function setNumeroCuenta($num)
    {
        $this->numeroCuenta = $num;
    }

    public function setPersona($p)
    {
        $this->persona = $p;
    }

    public function setSaldoActual($saldo)
    {
        $this->saldoActual = $saldo;
    }

    public function setInteresAnual($interes)
    {
        $this->interesAnual = $interes;
    }

    public function actualizarSaldo()
    {
        // Revisar bien como calcular el interés anual
        $this->setSaldoActual(($this->getInteresAnual()) / 365);
    }

    public function depositar($cant)
    {
        $this->setSaldoActual(($this->getSaldoActual()) + $cant);
    }

    public function retirar($cant)
    {
        $resultado = false;
        if (($this->getSaldoActual()) > 0) {
            $this->setSaldoActual(($this->getSaldoActual()) - $cant);
            $resultado = true;
        }
        return $resultado;
    }

    public function __toString()
    {
        $cadena = " ";
        $cadena= $cadena. "\n Número de cuenta: " . $this->getNumeroCuenta() .
        "\n Saldo Actual: " . $this->getSaldoActual() .
        "\n Interes Anual: " . $this->getInteresAnual() .
        "\n\n ---------Datos de la persona---------\n".$this->getPersona();
        return $cadena;
    }

}
