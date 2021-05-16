<?php
class Persona
{
    private $numDoc;
    private $nombre;
    private $apellido;

    public function __construct($num, $nom, $ape)
    {
        $this->numDoc = $num;
        $this->nombre = $nom;
        $this->apellido = $ape;
    }

    public function getNumDoc()
    {
        return $this->numDoc;
    }

    public function setNumDoc($numDoc)
    {
        $this->numDoc = $numDoc;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function __toString()
    {
        $cadena = "";
        $cadena .= "\nDNI: " . $this->getNumDoc();
        $cadena .= "\nNombre: " . $this->getNombre();
        $cadena .= "\nApellido: " . $this->getApellido();
        return $cadena;
    }
}
