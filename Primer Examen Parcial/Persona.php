<?php
class Persona{
    private $nombre;
    private $apellido;
    private $dni;
    private $direccion;
    private $mail;
    private $telefono;
    private $neto;

    public function __construct($pNom, $pApe, $pDni, $pDir, $pMail, $pTel, $pNeto){
        $this->nombre = $pNom;
        $this->apellido = $pApe;
        $this->dni = $pDni;
        $this->direccion = $pDir;
        $this->mail = $pMail;
        $this->telefono = $pTel;
        $this->neto = $pNeto;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getDni(){
        return $this->dni;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getMail(){
        return $this->mail;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function getNeto(){
        return $this->neto;
    }

    public function setNombre($pNom){
        $this->nombre = $pNom;
    }

    public function setApellido($pApe){
        $this->apellido = $pApe;
    }

    public function setDni($pDni){
        $this->dni = $pDni;
    }

    public function setDireccion($pDir){
        $this->direccion = $pDir;
    }

    public function setMail($pMail){
        $this->mail = $pMail;
    }

    public function setTelefono($pTel){
        $this->telefono = $pTel;
    }

    public function setNeto($pNeto){
        $this->neto = $pNeto;
    }

    public function __toString(){
        $cadena = "";
        $cadena .="\nNombre: ".$this->getNombre();
        $cadena .="\nApellido: ".$this->getApellido();
        $cadena .="\nDNI: ".$this->getDn();
        $cadena .="\nDirección: ".$this->getDireccion();
        $cadena .="\nMail: ".$this->getMail();
        $cadena .="\nTelefono: ".$this->getTelefono();
        $cadena .="\nNeto: ".$this->getNeto();
        return $cadena;
    }
}
