<?php
include 'Funcion.php';
class ObraTeatral extends Funcion{
    private $autor;

    public function __construct($pNombre, $pInicio, $pDuracion, $pPrecio, $pAutor){
        parent::__construct($pNombre, $pInicio, $pDuracion, $pPrecio);
        $this->autor = $pAutor;
    }

    /**
     * Get the value of autor
     */ 
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Set the value of autor
     *
     */ 
    public function setAutor($pAutor)
    {
        $this->autor = $pAutor;
    }
}