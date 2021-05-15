<?php
/**
 * PABLO DAMIAN ROMERO - FAI 1652
 * Enlace gitHub:
 */
class Cine extends Funcion
{
    /**
     * Declaración de variables
     */
    private $genero;
    private $paisOrigen;

    /**
     * Método constructor
     */
    public function __construct($pNombre, $pInicio, $pDuracion, $pPrecio, $pMes, $pGenero, $pOrigen)
    {
        parent::__construct($pNombre, $pInicio, $pDuracion, $pPrecio, $pMes);
        $this->genero = $pGenero;
        $this->paisOrigen = $pOrigen;
    }

    /**
     * Obtiene el valor de genero
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Obtiene el valor de paisOrigen
     */
    public function getPaisOrigen()
    {
        return $this->paisOrigen;
    }

    /**
     * Modifica el valor de genero
     */
    public function setGenero($pGenero)
    {
        $this->genero = $pGenero;
    }

    /**
     * Modifica el valor de paisOrigen
     */
    public function setPaisOrigen($pOrigen)
    {
        $this->paisOrigen = $pOrigen;
    }

    /**
     * Devuelve los datos de la clase
     */
    public function __toString()
    {
        $cadena = "";
        $cadena .= parent::__toString();
        $cadena .= "\n\t * Género: " . $this->getGenero();
        $cadena .= "\n\t * País de origen: " . $this->getPaisOrigen();
        return $cadena;
    }

    /**
     * Devuelve el precio de la función con calculo de incremento
     */
    public function recibirCosto()
    {
        $costo = parent::recibirCosto() * 0.65;
        return $costo;
    }
}
