<?php
class Categoria{
    private $idCategoria;
    private $descripcion;

    public function __construct($pId, $pDesc){
        $this->idCategoria = $pId;
        $this->descripcion = $pDesc;
    }

    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;

    }


    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

    }


    public function getIdCategoria()
    {
        return $this->idCategoria;
    }


    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function __toString(){
        $cadena = "";
        $cadena .= "\nId Categoria: ".$this->getIdCategoria();
        $cadena .= "\nDescripcion: ".$this->getDescripcion();
        return $cadena;
    }
}