<?php
class Funcion
{
    /**
     * Declaración de variables
     */
    private $nombreFuncion;
    private $horaInicio;
    private $duracion;
    private $precioFuncion;
    private $mes;

    /**
     * Método constructor
     */
    public function __construct($pNombre, $pInicio, $pDuracion, $pPrecio, $pMes)
    {
        $this->nombreFuncion = $pNombre;
        $this->horaInicio = $pInicio;
        $this->duracion = $pDuracion;
        $this->precioFuncion = $pPrecio;
        $this->mes = $pMes;
    }

    /**
     * Obtiene el valor de nombreFuncion
     */
    public function getNombreFuncion()
    {
        return $this->nombreFuncion;
    }

    /**
     * Obtiene el valor de horaInicio
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Obtiene el valor de duracion
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Obtiene el valor de precioFuncion
     */
    public function getPrecioFuncion()
    {
        return $this->precioFuncion;
    }

    /**
     * Obtiene el valor de mes
     */
    public function getMes()
    {
        return $this->mes;
    }

    /**
     * Modifica el valor de nombreFuncion
     */
    public function setNombreFuncion($pNombre)
    {
        $this->nombreFuncion = $pNombre;
    }

    /**
     * Modifica el valor de horaInicio
     */
    public function setHoraInicio($pInicio)
    {
        $this->horaInicio = $pInicio;
    }

    /**
     * Modifica el valor de duracion
     */
    public function setDuracion($pDuracion)
    {
        $this->duracion = $pDuracion;
    }

    /**
     * Modifica el valor de precioFuncion
     */
    public function setPrecioFuncion($pPrecio)
    {
        $this->precioFuncion = $pPrecio;
    }

    /**
     * Modifica el valor de mes
     */
    public function setMes($pMes)
    {
        $this->mes = $pMes;
    }

    /**
     * Devuelve los datos de la clase
     */
    public function __toString()
    {
        $cadena = "";
        $cadena .= "\n\t Nombre de la función: " . $this->getNombreFuncion();
        $cadena .= "\n\t Hora de inicio: " . $this->getHoraInicio();
        $cadena .= "\n\t Duración: " . $this->getDuracion();
        $cadena .= "\n\t Precio: " . $this->getPrecioFuncion();
        $cadena .= "\n\t Mes: " . $this->getMes();
        return $cadena;
    }

    /**
     *  Calcula la duración total de la función
     */
    public function tiempoTotalDeLaFuncion()
    {
        $total = $this->getHoraInicio() + $this->getDuracion();
        return $total;
    }

    /**
     * Devuelve el precio de la función
     */
    public function recibirCosto()
    {
        $costo = $this->getPrecioFuncion();
        return $costo;
    }

}
