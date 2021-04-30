<?php
class Persona{
    private $dni;
    private $nombre;
    private $apellido;

    public function __construct($pDni, $pNom, $pApe){
        $this->dni = $pDni;
        $this->nombre = $pNom;
        $this->apellido = $pApe;
    }

    

    /**
     * Get the value of dni
     */ 
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set the value of dni
     *
     * @return  self
     */ 
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }


    public function getApellido()
    {
        return $this->apellido;
    }


    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

    }

    public function __toString(){
        $cadena = "";
        $cadena .= "\nDNI: ".$this->getDni();
        $cadena .= "\nNombre: ".$this->getNombre();
        $cadena .= "\nApellido: ".$this->getApellido();
        return $cadena;
    }
}