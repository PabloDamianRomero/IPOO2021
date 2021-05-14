<?php

class Persona
{
    private $nombre;
    private $apellido;
    private $tipoDoc;
    private $nroDoc;

    public function __construct($pNom, $pApe, $pTipo, $pNro)
    {
        $this->nombre = $pNom;
        $this->apellido = $pApe;
        $this->tipoDoc = $pTipo;
        $this->nroDoc = $pNro;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getTipoDoc()
    {
        return $this->tipoDoc;
    }

    public function getNroDoc()
    {
        return $this->nroDoc;
    }

    public function setNombre($pNom)
    {
        $this->nombre = $pNom;
    }

    public function setApellido($pApe)
    {
        $this->apellido = $pApe;
    }

    public function setTipoDoc($pTipo)
    {
        $this->tipoDoc = $pTipo;
    }

    public function setNroDoc($pNro)
    {
        $this->nroDoc = $pNro;
    }

    public function __toString()
    {
        return "\n Nombre: " . $this->getNombre() .
        "\n Apellido: " . $this->getApellido() .
        "\n Tipo de documento: " . $this->getTipoDoc() .
        "\n Número de documento: " . $this->getNroDoc() . "\n";
    }
}
