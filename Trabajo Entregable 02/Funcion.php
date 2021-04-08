<?php
/**
 * PABLO DAMIAN ROMERO - FAI 1652
 *
 * Enlace gitHub: https://github.com/PabloDamianRomero/IPOO2021.git
 * 
 * Nombre de la carpeta en el repositorio: Trabajo Entregable 02
 *
 * 
 * Modificar la clase Teatro (Ejercicio 15 TP 1) para que ahora las funciones sean un objeto 
 * que tenga las variables nombre, horario de inicio, duración de la obra y precio.
 * El teatro ahora, contiene una referencia a una colección de objetos de la clase  Funciones; las cuales pueden variar en cantidad y en horario.
 * Volver a implementar las operaciones que permiten modificar el nombre y el precio de una función. 
 * Luego implementar la operación que carga las funciones de un teatro, solicitando por consola la información de las mismas. 
 * También se debe verificar que el horario de las funciones, no se solapen para un mismo teatro.
 * */
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
        $cadena = "\n-------------------------------------------";
        $cadena .= "\n\t Nombre de la función: " . $this->getNombreFuncion();
        $cadena .= "\n\t Hora de inicio: " . $this->getHoraInicio();
        $cadena .= "\n\t Duración: " . $this->getDuracion();
        $cadena .= "\n\t Precio: " . $this->getPrecioFuncion();
        $cadena .= "\n-------------------------------------------";
        return $cadena;
    }
}
