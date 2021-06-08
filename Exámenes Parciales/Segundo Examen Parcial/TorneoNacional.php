<?php
class TorneoNacional extends Torneo{

    public function __construct($pIdTorneo, $pMonto, $pColObjPartidos)
    {
        parent::__construct($pIdTorneo, $pMonto, $pColObjPartidos);
    }

    public function obtenerPremioTorneo(){
        $colEquipoYPremio = parent::obtenerPremioTorneo();
        $incrementoNacional = $colEquipoYPremio[0]["premio"] + ((10*$this->getMontoPremio())/100) * $colEquipoYPremio[0]["partidos"];
        $premioNacional = array();
        $premioNacional[0] = array("equipoGanador"=>$colEquipoYPremio[0]["equipoGanador"], "premio"=>$incrementoNacional);
        return $premioNacional;
    }
}