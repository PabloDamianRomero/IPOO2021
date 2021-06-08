<?php
class MinisterioDeporte
{
    private $anioTorneo;
    private $colObjTorneos;

    public function __construct($pAnioT, $pColObjT)
    {
        $this->anioTorneo = $pAnioT;
        $this->colObjTorneos = $pColObjT;
    }

    public function setAnioTorneo($anioTorneo)
    {
        $this->anioTorneo = $anioTorneo;

    }

    public function setColObjTorneos($colObjTorneos)
    {
        $this->colObjTorneos = $colObjTorneos;

    }

    public function getAnioTorneo()
    {
        return $this->anioTorneo;
    }

    public function getColObjTorneos()
    {
        return $this->colObjTorneos;
    }

    public function __toString()
    {
        $cadena = "";
        $cadena .= "\nAño del torneo: " . $this->getAnioTorneo();
        $cadena .= "\nTorneos: " . $this->mostrarColeccion($this->getColObjTorneos());
        return $cadena;
    }

    private function mostrarColeccion($unaCol)
    {
        $longitud = count($unaCol);
        $cadena = "";
        for ($i = 0; $i < $longitud; $i++) {
            $cadena .= "\n " . $unaCol[$i];
        }
        return $cadena;
    }

    public function registrarTorneo($colPartidos, $tipo, $arrayAsociativo){
        $instanciaTorneo = null;
        $colTorneos = $this->getColObjTorneos();
        if($tipo == "provinciales"){
            // $prov[0] = array("id" => "torneo_05", "monto" => 600, "nombreProvincia"=>"Rio Negro"),
            $colDeProvincia = $arrayAsociativo["provincial"];
            $idTorneoProv = $colDeProvincia[0]["id"];
            $montoProv = $colDeProvincia[0]["monto"];
            $nomProvincia = $colDeProvincia[0]["nombreProvincia"];
            $instanciaTorneo = new TorneoProvincial($idTorneoProv, $montoProv, $colPartidos, $nomProvincia);
            array_push($colTorneos, $instanciaTorneo);
        }elseif($tipo == "nacionales"){
            // $nac[0] = array("id" => "torneo_03", "monto" => 400),
            $colDeNacional = $arrayAsociativo["nacional"];
            $idTorneoNac = $colDeNacional[0]["id"];
            $montoNac = $colDeNacional[0]["monto"];
            $instanciaTorneo = new TorneoNacional($idTorneoNac, $montoNac, $colPartidos);
            array_push($colTorneos, $instanciaTorneo);
        }
        $this->setColObjTorneos($colTorneos);
        return $instanciaTorneo;
    }

    public function otorgarPremioTorneo($idTorneo){
        $colTorneos = $this->getColObjTorneos();
        $longitud = count($colTorneos);
        $seguir = true;
        $i = 0;
        while(($i<$longitud) && ($seguir)){
            $objTorneo = $colTorneos[$i];
            if($objTorneo->getIdTorneo() == $idTorneo){
                $seguir = false;
            }
            $i++;
        }
        $colEquipoPremioPartidos = $objTorneo->obtenerPremioTorneo();
        $colEquipoConSuPremio = array();
        if(!$seguir){
            $colEquipoConSuPremio[0] = array("refAlEquipoGanador"=>$colEquipoPremioPartidos[0]["equipoGanador"], "premioCorrespondiente"=>$colEquipoPremioPartidos[0]["premio"]);
        }
        return $colEquipoConSuPremio;
    }
}
