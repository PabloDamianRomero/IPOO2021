<?php
class Persona
{
    private $tipoDoc;
    private $nroDoc;
    private $nombre;
    private $apellido;
    private $telefono;

    public function __construct($pTipoDoc, $pNroDoc, $pNom, $pApe, $pTel)
    {
        $this->tipoDoc = $pTipoDoc;
        $this->nroDoc = $pNroDoc;
        $this->nombre = $pNom;
        $this->apellido = $pApe;
        $this->telefono = $pTel;
    }

    public function getTipoDoc()
    {
        return $this->tipoDoc;
    }

    public function getNroDoc()
    {
        return $this->nroDoc;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTipoDoc($pTipoDoc)
    {
        $this->tipoDoc = $pTipoDoc;
    }

    public function setNroDoc($pNroDoc)
    {
        $this->nroDoc = $pNroDoc;
    }

    public function setNombre($pNom)
    {
        $this->nombre = $pNom;
    }

    public function setAepllido($pApe)
    {
        $this->apellido = $pApe;
    }

    public function setTelefono($pTel)
    {
        $this->telefono = $pTel;
    }

    public function __toString()
    {
        $cadena = "";
        $cadena .= "\nTipo documento:  " . $this->getTipoDoc();
        $cadena .= "\nNúmero documento " . $this->getNroDoc();
        $cadena .= "\nNombre:          " . $this->getNombre();
        $cadena .= "\nApellido:        " . $this->getApellido();
        $cadena .= "\nTeléfono:        " . $this->getTelefono();
        return $cadena;
    }
}
