<?php
include 'Cuota.php';
class Prestamo{
    private $identificacion;
    private $patenteVehiculo;
    private $fechaOtorgamiento;
    private $monto;
    private $cantidadCuotas;
    private $tazaInteres;
    private $colObjCuotas;
    private $objPersona;

    public function __construct($pID, $pMonto, $pCantCuotas, $pTazaInteres, $pObjPersona){
        $this->identificacion = $pID;
        $this->patenteVehiculo = null;
        $this->fechaOtorgamiento = null;
        $this->monto = $pMonto;
        $this->cantidadCuotas = $pCantCuotas;
        $this->tazaInteres = $pTazaInteres;
        $this->colObjCuotas = array();
        $this->objPersona = $pObjPersona;
    }

    public function getIdentificacion(){
        return $this->identificacion;
    }

    public function getPatenteVehiculo(){
        return $this->patenteVehiculo;
    }

    public function getFechaOtorgamiento(){
        return $this->fechaOtorgamiento;
    }

    public function getMonto(){
        return $this->monto;
    }

    public function getCantidadCuotas(){
        return $this->cantidadCuotas;
    }

    public function getTazaInteres(){
        return $this->tazaInteres;
    }

    public function getColCuotas(){
        return $this->colObjCuotas;
    }

    public function getObjPersona(){
        return $this->objPersona;
    }

    public function setIdentificacion($pID){
        $this->identificacion = $pID;
    }

    public function setPatenteVehiculo($pPantente){
        $this->patenteVehiculo = $pPantente;
    }

    public function setFechaOtorgamiento($pFecha){
        $this->fechaOtorgamiento = $pFecha;
    }

    public function setMonto($pMonto){
        $this->monto = $pMonto;
    }

    public function setCantidadCuotas($pCantCuotas){
        $this->cantidadCuotas = $pCantCuotas;
    }

    public function setTazaInteres($pTazaInteres){
        $this->tazaInteres = $pTazaInteres;
    }

    public function setColCuotas($pColCuotas){
        $this->colObjCuotas = $pColCuotas;
    }

    public function setObjPersona($pObjPersona){
        $this->objPersona = $pObjPersona;
    }

    public function __toString(){
        $cadena = "";
        $cadena .= "\nID Prestamo: ".$this->getIdentificacion();
        $cadena .= "\nPatente vehiculo: ".$this->getPatenteVehiculo();
        $cadena .= "\nFecha Otorgamiento: ".$this->getFechaOtorgamiento();
        $cadena .= "\nMonto: ".$this->getMonto();
        $cadena .= "\nCantidad de cuotas: ".$this->getCantidadCuotas();
        $cadena .= "\nTaza de interes: ".$this->getTazaInteres();
        $cadena .= "\n*Cuotas: ".$this->mostrarColeccion($this->getColCuotas());
        $cadena .= "\nPersona solicitante: ".$this->getObjPersona();
        return $cadena;
    }

    public function mostrarColeccion($col){
        $cadena = "";
        $longitud = count($col);
        for($i=0;$i<$longitud;$i++){
            $cadena .= "\n ".$col[$i];
        }
        return $cadena;
    }

    private function calcularInteresPrestamo($numCuota){
        $monto = $this->getMonto();
        $cantCuotas = $this->getCantidadCuotas();
        $tazaInteres = $this->getTazaInteres();
        $interesCuota = ($monto - (($monto/$cantCuotas)*$numCuota-1))*$tazaInteres;
        return $interesCuota;
    }
    
    public function otorgarPrestamo(){
        $colCuotas = $this->getColCuotas();
        $cantidadCuotas = $this->getCantidadCuotas();
        $cuota = null;
        for($i=0;$i<$cantidadCuotas;$i++){
            $monto = $this->getMonto();
            $importeTotal = $monto/$cantidadCuotas;
            $interes = $this->calcularInteresPrestamo($i);
            $cuota = new Cuota($i, $monto, $interes);
            $this->setFechaOtorgamiento(getdate());
            $colCuotas[count($colCuotas)] = $cuota;
        }
        $this->setColCuotas($colCuotas);
    }

    public function darSiguienteCuotaPagar(){
        $refCuota = null;
        $seguir = true;
        $i=0;
        $colCuotas = $this->getColCuotas();
        $longitud = count($colCuotas);
        while(($i<$longitud)&&($seguir)){
            if($colCuotas[$i]->getCancelada() == false){
                $refCuota = $$colCuotas[$i];
                $seguir = false;
            }
            $i++;
        }
        return $refCuota;
    }
}