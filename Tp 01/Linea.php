<?php
class Linea
{
    private $pA;
    private $pB;
    private $pC;
    private $pD;

    public function __construct($ptoA, $ptoB, $ptoC, $ptoD)
    {
        $this->pA = $ptoA;
        $this->pB = $ptoB;
        $this->pC = $ptoC;
        $this->pD = $ptoD;
    }

    public function getPuntoA()
    {
        return $this->pA;
    }

    public function getPuntoB()
    {
        return $this->pB;
    }

    public function getPuntoC()
    {
        return $this->pC;
    }

    public function getPuntoD()
    {
        return $this->pD;
    }

    public function setPuntoA($ptoA)
    {
        $this->pA = $ptoA;
    }

    public function setPuntoB($ptoB)
    {
        $this->pB = $ptoB;
    }

    public function setPuntoC($ptoC)
    {
        $this->pC = $ptoC;
    }

    public function setPuntoD($ptoD)
    {
        $this->pD = $ptoD;
    }

    public function __toString()
    {
        $cadena = " ";
        $cadena = $cadena . "\nPto1 = (" . $this->getPuntoA() . "," . $this->getPuntoB() . ")";
        $cadena = $cadena . "\tPto2 = (" . $this->getPuntoC() . "," . $this->getPuntoD() . ")\n";
        return $cadena;
    }

    public function mueveDerecha($d)
    {
        $this->setPuntoA($this->getPuntoA() + $d);
        $this->setPuntoC($this->getPuntoC() + $d);
    }

    public function mueveIzquierda($d)
    {
        $this->setPuntoA($this->getPuntoA() - $d);
        $this->setPuntoC($this->getPuntoC() - $d);
    }

    public function mueveArriba($d)
    {
        $this->setPuntoB($this->getPuntoB() + $d);
        $this->setPuntoD($this->getPuntoD() + $d);
    }

    public function mueveAbajo($d)
    {
        $this->setPuntoB($this->getPuntoB() - $d);
        $this->setPuntoD($this->getPuntoD() - $d);
    }
}
