<?php
class TorneoProvincial extends Torneo
{
    private $nombreProvincia;

    public function __construct($pIdTorneo, $pMonto, $pColObjPartidos, $pNombreProv)
    {
        parent::__construct($pIdTorneo, $pMonto, $pColObjPartidos);
        $this->nombreProvincia = $pNombreProv;
    }

    public function setNombreProvincia($nombreProvincia)
    {
        $this->nombreProvincia = $nombreProvincia;

    }

    public function getNombreProvincia()
    {
        return $this->nombreProvincia;
    }

    public function __toString()
    {
        $cadena = "";
        $cadena .= parent::__toString();
        $cadena .= "\nNombre Provincia: " . $this->getNombreProvincia();
        return $cadena;
    }
}
