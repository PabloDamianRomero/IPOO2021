<?php
class Torneo
{
    private $idTorneo;
    private $montoPremio;
    private $colObjPartidos;

    public function __construct($pIdTorneo, $pMonto, $pColObjPartidos)
    {
        $this->idTorneo = $pIdTorneo;
        $this->montoPremio = $pMonto;
        $this->colObjPartidos = $pColObjPartidos;
    }

    public function setIdTorneo($idTorneo)
    {
        $this->idTorneo = $idTorneo;
    }

    public function setMontoPremio($montoPremio)
    {
        $this->montoPremio = $montoPremio;

    }

    public function setColObjPartidos($colObjPartidos)
    {
        $this->colObjPartidos = $colObjPartidos;

    }

    public function getIdTorneo()
    {
        return $this->idTorneo;
    }

    public function getMontoPremio()
    {
        return $this->montoPremio;
    }

    public function getColObjPartidos()
    {
        return $this->colObjPartidos;
    }

    public function __toString()
    {
        $cadena = "";
        $cadena .= "\nID Torneo: " . $this->getIdTorneo();
        $cadena .= "\nMonto premio economico: " . $this->getMontoPremio();
        $cadena .= "\nPartidos: " . $this->mostrarColeccion($this->getColObjPartidos());
        return $cadena;
    }

    private function mostrarColeccion($unaCol)
    {
        $cadena = "";
        $longitud = count($unaCol);
        for ($i = 0; $i < $longitud; $i++) {
            $cadena .= "\n " . $unaCol[$i];
        }
        return $cadena;
    }

    public function obtenerEquipoGanadorTorneo()
    {
        $colGanador = array();
        $colPartidos = $this->getColObjPartidos();
        $longitud = count($colPartidos);
        $cantidadPartidosGanadosE1 = 0;
        $cantidadPartidosGanadosE2 = 0;
        $cantidadGolesTotalE1 = 0;
        $cantidadGolesTotalE2 = 0;
        $equipoGanador = null;
        for ($i = 0; $i < $longitud; $i++) {
            $partidoActual = $colPartidos[$i];
            $golesEquipo1 = $partidoActual->getCantGolesE1();
            $golesEquipo2 = $partidoActual->getCantGolesE2();
            if ($golesEquipo1 > $golesEquipo2) {
                $equipoGanador = $partidoActual->getObjEquipo1();
                $cantidadGolesTotalE1 = $cantidadGolesTotalE1 + $golesEquipo1;
                $cantidadPartidosGanadosE1++;
                $colGanador[$i] = array("equipo" => $equipoGanador, "cantGolesTotal" => $cantidadGolesTotalE1, "partidosGanados" => $cantidadPartidosGanadosE1);
            } else {
                $equipoGanador = $partidoActual->getObjEquipo2();
                $cantidadGolesTotalE2 = $cantidadGolesTotalE2 + $golesEquipo2;
                $cantidadPartidosGanadosE2++;
                $colGanador[$i] = array("equipo" => $equipoGanador, "cantGolesTotal" => $cantidadGolesTotalE2, "partidosGanados" => $cantidadPartidosGanadosE2);
            }
        }
        return $colGanador;
    }

    public function obtenerPremioTorneo()
    {
        $premio = 0;
        $colGanadoresTotal = $this->obtenerEquipoGanadorTorneo();
        $equipoGanadorConPartidosGanados = $this->buscarEquipoGanador($colGanadoresTotal);
        $colEquipoGanadorYPremio = array();
        if(count($equipoGanadorConPartidosGanados)>0){
            $premio = $this->getMontoPremio();
            $colEquipoGanadorYPremio[0] = array("equipoGanador"=>$equipoGanadorConPartidosGanados[0]["refEquipo"], "premio"=>$premio, "partidos"=>$equipoGanadorConPartidosGanados[0]["cantPartidosGanados"]);
        }
        return $colEquipoGanadorYPremio;
    }

    private function buscarEquipoGanador($colGanadores){
        $longitud = count($colGanadores);
        $mayor = 0;
        $equipoGanadorYPartidosGanados = array();
        for ($i = 0; $i < $longitud; $i++) {
            $cantPartidosGanados = $colGanadores[$i]["partidosGanados"];
            if($cantPartidosGanados > $mayor){
                $mayor = $cantPartidosGanados;
                $equipoGanadorYPartidosGanados[0] = array("refEquipo"=>$colGanadores[$i]["equipo"], "cantPartidosGanados"=>$colGanadores[$i]["partidosGanados"]);
            }
        }
        return $equipoGanadorYPartidosGanados;
    }


}
