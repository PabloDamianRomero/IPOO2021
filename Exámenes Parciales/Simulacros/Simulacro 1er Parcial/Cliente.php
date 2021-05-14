<?php
class Cliente{
    private $nombre;
    private $apellido;
    private $dadoDeBaja;
    private $tipoDocumento;
    private $nroDocumento;

    public function __construct($pNom, $pApe, $pBaja, $pTipo, $pNro){
        $this->nombre = $pNom;
        $this->apellido = $pApe;
        $this->dadoDeBaja = $pBaja;
        $this->tipoDocumento = $pTipo;
        $this->nroDocumento = $pNro;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getEstadoBaja(){
        return $this->dadoDeBaja;
    }

    public function getTipoDocumento(){
        return $this->tipoDocumento;
    }

    public function getNroDocumento(){
        return $this->nroDocumento;
    }

    public function setNombre($pNom){
        $this->nombre = $pNom;
    }

    public function setApellido($pApe){
        $this->apellido = $pApe;
    }

    public function setEstadoBaja($pBaja){
        $this->dadoDeBaja = $pBaja;
    }

    public function setTipoDocumento($pTipo){
        $this->tipoDocumento = $pTipo;
    }

    public function setNroDocumento($pNro){
        $this->nroDocumento = $pNro;
    }

    public function __toString(){
        $cadena = "";
        $cadena .= "\nNombre: ".$this->getNombre();
        $cadena .= "\nApellido: ".$this->getApellido();
        $cadena .= "\nDado de baja: ".$this->getEstadoBaja();
        $cadena .= "\nTipo documento: ".$this->getTipoDocumento();
        $cadena .= "\nNúmero documento: ".$this->getNroDocumento();
        return $cadena;
    }
}