<?php
class Funcion
{
    private $nombreFuncion;
    private $horaInicio;
    private $duracion;
    private $precioFuncion;

    public function __construct($pNombre, $pInicio, $pDuracion, $pPrecio)
    {
        $this->nombreFuncion = $pNombre;
        $this->horaInicio = $pInicio;
        $this->duracion = $pDuracion;
        $this->precioFuncion = $pPrecio;
    }

    public function getNombreFuncion()
    {
        return $this->nombreFuncion;
    }

    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    public function getDuracion()
    {
        return $this->duracion;
    }

    public function getPrecioFuncion()
    {
        return $this->precioFuncion;
    }

    public function setNombreFuncion($pNombre)
    {
        $this->nombreFuncion = $pNombre;
    }

    public function setHoraInicio()
    {
        $this->horaInicio = $pInicio;
    }

    public function setDuracion($pDuracion)
    {
        $this->duracion = $pDuracion;
    }

    public function setPrecioFuncion($pPrecio)
    {
        $this->precioFuncion = $pPrecio;
    }

    public function __toString()
    {
        $cadena = "";
        $cadena .= "\n\t Nombre de la función: " . $this->getNombreFuncion();
        $cadena .= "\n\t Hora de inicio: " . $this->getHoraInicio();
        $cadena .= "\n\t Duración: " . $this->getDuracion();
        $cadena .= "\n\t Precio: " . $this->getPrecioFuncion();
        return $cadena;
    }

    /**
     *
     */
    public function tiempoTotalDeLaFuncion()
    {
        $total = $this->getHoraInicio() + $this->getDuracion();
        return $total;
    }


    public function recibirCosto(){
        $costo = $this->getPrecioFuncion();
        return $costo;
    }
}
