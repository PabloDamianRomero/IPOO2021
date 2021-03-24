<?php
class CuentaBancaria
{

    private $numeroCuenta;
    private $dni;
    private $saldoActual;
    private $interesAnual;

    public function __construct($cuenta, $doc, $saldo, $interes)
    {
        $this->numeroCuenta = $cuenta;
        $this->dni = $doc;
        $this->saldoActual = $saldo;
        $this->interesAnual = $interes;
    }

    public function getNumeroCuenta()
    {
        return $this->numeroCuenta;
    }

    public function getDni()
    {
        return $this->dni;
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

    public function setDni($doc)
    {
        $this->numeroCuenta = $doc;
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
        return "\n Número de cuenta: " . $this->getNumeroCuenta() .
        "\n DNI: " . $this->getDni() .
        "\n Saldo Actual: " . $this->getSaldoActual() .
        "\n Interes Anual: " . $this->getInteresAnual() .
        "\n";
    }

}
