<?php
class Cliente
{
    private $dni;
    private $objTramite;

    public function __construct($pDni, $pObjTramite)
    {
        $this->dni = $pDni;
        $this->objTramite = $pObjTramite;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function getTramite()
    {
        return $this->objTramite;
    }

    public function setDni($pDni)
    {
        $this->dni = $pDni;
    }

    public function setTramite($pObjTramite)
    {
        $this->objTramite = $pObjTramite;
    }

    public function __toString()
    {
        $cadena = "";
        $cadena .= "\n\t\t D.N.I.: " . $this->getDni();
        $cadena .= "\n\t\t\t ====Tramite==== \n " . $this->getTramite()->__toString();
        return $cadena;
    }

}
