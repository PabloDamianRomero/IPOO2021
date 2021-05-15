<?php
/**
 * PABLO DAMIAN ROMERO - FAI 1652
 * Enlace gitHub: https://github.com/PabloDamianRomero/IPOO2021/tree/main/Trabajos%20Entregables%20Obligatorios/Trabajo%20Entregable%2003
 */
class ObraTeatral extends Funcion
{
    /**
     * Declaración de variables
     */
    private $autor;

    /**
     * Método constructor
     */
    public function __construct($pNombre, $pInicio, $pDuracion, $pPrecio, $pMes, $pAutor)
    {
        parent::__construct($pNombre, $pInicio, $pDuracion, $pPrecio, $pMes);
        $this->autor = $pAutor;
    }

    /**
     * Obtiene el valor de autor
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Modifica el valor de autor
     */
    public function setAutor($pAutor)
    {
        $this->autor = $pAutor;
    }

    /**
     * Devuelve los datos de la clase
     */
    public function __toString()
    {
        $cadena = "";
        $cadena .= parent::__toString();
        $cadena .= "\n\t * Autor: " . $this->getAutor();
        return $cadena;
    }

    /**
     * Devuelve el precio de la función con calculo de incremento
     */
    public function recibirCosto()
    {
        $costo = parent::recibirCosto() * 0.45;
        return $costo;
    }
}
