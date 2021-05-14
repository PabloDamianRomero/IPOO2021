<?php
class Cafetera
{

    private $capacidadMaxima;
    private $cantidadActual;

    public function __construct($capMax, $canAct)
    {
        $this->capacidadMaxima = $capMax;
        $this->cantidadActual = $canAct;
    }

    public function getCapacidadMaxima()
    {
        return $this->capacidadMaxima;
    }

    public function getCantidadActual()
    {
        return $this->cantidadActual;
    }

    public function setCapacidadMaxima($capMax)
    {
        $this->capacidadMaxima = $capMax;
    }

    public function setCantidadActual($canAct)
    {
        $this->cantidadActual = $canAct;
    }

    public function llenarCafetera()
    {
        $this->setCantidadActual($this->getCapacidadMaxima());
    }

    public function servirTaza($cantidad)
    {
        if (($cantidad + $this->getCantidadActual()) < $this->getCapacidadMaxima()) {
            $this->setCantidadActual($cantidad + $this->getCantidadActual());
            $mensaje = "\nNo se alcanzó a llenar la taza, pero se sirvió con éxito.";
        } elseif (($cantidad + $this->getCantidadActual()) == $this->getCapacidadMaxima()) {
            $this->setCantidadActual($cantidad + $this->getCantidadActual());
            $mensaje = "\nSe ha servido con éxito. La taza está llena.";
        } else {
            $mensaje = "\nNo se puede servir esa cantidad de café. La taza se rebalsaría.";
        }
        return $mensaje;
    }

    public function vaciarCafetera()
    {
        $this->setCantidadActual(0);
    }

    public function agregarCafe($cantidad)
    {
        $this->setCantidadActual($cantidad);
    }

    public function __toString()
    {
        return "\n Capacidad máxima: " . $this->getCapacidadMaxima() . "\n Cantidad actual: " . $this->getCantidadActual();
    }

}
