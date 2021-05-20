<?php
class Categoria{
    private $idCategoria; 
    private $descripcion; // (Menores/Juveniles/Mayores)

    public function __construct($pId, $pDesc){
        $this->idCategoria = $pId;
        $this->descripcion = $pDesc;
    }

    public function setIdCategoria($pId)
    {
        $this->idCategoria = $pId;
    }

    public function setDescripcion($pDesc)
    {
        $this->descripcion = $pDesc;
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
        $cadena .= "\n\t\tID Categoría: ".$this->getIdCategoria();
        $cadena .= "\n\t\tDescripcion: ".$this->getDescripcion();
        return $cadena;
    }
}