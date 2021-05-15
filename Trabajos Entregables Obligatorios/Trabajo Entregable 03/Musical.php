<?php
/**
 * PABLO DAMIAN ROMERO - FAI 1652
 * Enlace gitHub: https://github.com/PabloDamianRomero/IPOO2021/tree/main/Trabajos%20Entregables%20Obligatorios/Trabajo%20Entregable%2003
 */
class Musical extends Funcion
{
    /**
     * Declaración de variables
     */
    private $director;
    private $cantPersonasEscena;

    /**
     * Método constructor
     */
    public function __construct($pNombre, $pInicio, $pDuracion, $pPrecio, $pMes, $pDirector, $pCant)
    {
        parent::__construct($pNombre, $pInicio, $pDuracion, $pPrecio, $pMes);
        $this->director = $pDirector;
        $this->cantPersonasEscena = $pCant;
    }

    /**
     * Obtiene el valor de director
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Obtiene el valor de cantPersonasEscena
     */
    public function getCantPersonasEscena()
    {
        return $this->cantPersonasEscena;
    }

    /**
     * Modifica el valor de director
     */
    public function setDirector($pDirector)
    {
        $this->director = $pDirector;
    }

    /**
     * Modifica el valor de cantPersonasEscena
     */
    public function setCantPersonasEscena($pCant)
    {
        $this->cantPersonasEscena = $pCant;
    }

    /**
     * Devuelve los datos de la clase
     */
    public function __toString()
    {
        $cadena = "";
        $cadena .= parent::__toString();
        $cadena .= "\n\t * Director: " . $this->getDirector();
        $cadena .= "\n\t * Personas en escena: " . $this->getCantPersonasEscena();
        return $cadena;
    }

    /**
     * Devuelve el precio de la función con calculo de incremento
     */
    public function recibirCosto()
    {
        $costo = parent::recibirCosto() * 0.12;
        return $costo;
    }
}
