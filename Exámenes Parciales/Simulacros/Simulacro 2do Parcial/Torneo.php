<?php
class Torneo
{
    private $colObjPartidos;
    private $importe;

    public function __construct($pColObjPartidos, $pImporte)
    {
        $this->colObjPartidos = $pColObjPartidos;
        $this->importe = $pImporte;
    }

    public function setColObjPartidos($pColObjPartidos)
    {
        $this->colObjPartidos = $pColObjPartidos;
    }

    public function setImporte($pImporte)
    {
        $this->importe = $pImporte;
    }

    public function getColObjPartidos()
    {
        return $this->colObjPartidos;
    }

    public function getImporte()
    {
        return $this->importe;
    }

    public function __toString()
    {
        $cadena = "";
        $cadena .= "\n=========================================================================";
        $cadena .= "\nPARTIDOS: " . $this->mostrarColeccion($this->getColObjPartidos());
        $cadena .= "\nImporte: " . $this->getImporte();
        $cadena .= "\n=========================================================================";
        return $cadena;
    }

    private function mostrarColeccion($unaCol)
    {
        $longitud = count($unaCol);
        $cadena = "";
        for ($i = 0; $i < $longitud; $i++) {
            $cadena .= "\n" . $unaCol[$i];
        }
        return $cadena;
    }

    public function ingresarPartido($objEquipo1, $objEquipo2, $fecha, $tipo)
    {
        $objPartido = null;
        $categoria1 = $objEquipo1->getObjCategoria()->getDescripcion();
        $categoria2 = $objEquipo2->getObjCategoria()->getDescripcion();
        $cantJugadores1 = $objEquipo1->getCantJugadores();
        $cantJugadores2 = $objEquipo2->getCantJugadores();
        if (($categoria1 == $categoria2) && ($cantJugadores1 == $cantJugadores2)) {
            // Si ambos equipos son de la misma categoria y tienen misma cant jugadores
            if ($tipo == "futbol") {
                $objPartido = new Futbol($objEquipo1, $objEquipo2, $fecha, 0, 0);
                $objPartido->setIdPartido($objPartido->getIdPartido() + 1);
            }
            if ($tipo == "basquetbol") {
                $objPartido = new Basket($objEquipo1, $objEquipo2, $fecha, 0, 0, 0);
                $objPartido->setIdPartido($objPartido->getIdPartido() + 1);
            }
            $colPartidos = $this->getColObjPartidos();
            array_push($colPartidos, $objPartido);
            $this->setColObjPartidos($colPartidos);
        }
        return $objPartido;
    }

    public function darGanadores($deporte)
    {
        $colGanadores = array();
        $colPartidos = $this->getColObjPartidos();
        $longitud = count($colPartidos);
        $deporte = strtolower($deporte);
        for ($i = 0; $i < $longitud; $i++) {
            $tipoPartido = strtolower(get_class($colPartidos[$i]));
            if($tipoPartido == $deporte){
                $objEquipo1 = $colPartidos[$i]->getObjEquipo1();
                $objEquipo2 = $colPartidos[$i]->getObjEquipo2();
                $golesEq1 = $colPartidos[$i]->getCantGolesE1();
                $golesEq2 = $colPartidos[$i]->getCantGolesE2();
                if($golesEq1>$golesEq2){
                    array_push($colGanadores, $objEquipo1);
                }else{
                    array_push($colGanadores, $objEquipo2);
                }
            }
        }
        return $colGanadores;
    }

    public function calcularPremioPartido($objPartido){
        $colPremio = array();
        $cantGoles1 = $objPartido->getCantGolesE1();
        $cantGoles2 = $objPartido->getCantGolesE2();
        if($cantGoles1>$cantGoles2){
            $equipoGanador = $objPartido->getObjEquipo1();
        }else{
            $equipoGanador = $objPartido->getObjEquipo2();
        }
        $premio = $objPartido->coeficientePartido() * $this->getImporte();
        $colPremio[0] = array("equipoGanador"=>$equipoGanador, "premioPartido"=>$premio);
        return $colPremio;
    }

}
