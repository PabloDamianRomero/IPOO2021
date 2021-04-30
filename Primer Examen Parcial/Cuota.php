<?php
class Cuota{
    private $numero;
    private $montoCuota;
    private $montoInteres;
    private $cancelada;

    public function __construct($pNum, $pMontoCuota, $pMontoInteres){
        $this->numero = $pNumero;
        $this->montoCuota = $pMontoCuota;
        $this->montoInteres = $pMontoInteres;
        $this->cancelada = false;
    }

    public function getNumeroCuota(){
        return $this->numero;
    }

    public function getMontoCuota(){
        return $this->montoCuota;
    }

    public function getMontoInteres(){
        return $this->montoInteres;
    }

    public function getCancelada(){
        return $this->cancelada;
    }

    public function setNumeroCuota($pNum){
        $this->numero = $pNum;
    }

    public function setMontoCuota($pMontoCuota){
        $this->montoCuota = $pMontoCuota;
    }

    public function setMontoInteres($pMontoInteres){
        $this->montoInteres = $pMontoInteres;
    }

    public function setCancelada($pCancelada){
        $this->cancelada = $pCancelada;
    }

    public function __toString(){
        $cadena = "";
        $cadena .="\nNúmero Cuota: ".$this->getNumeroCuota();
        $cadena .="\nMonto Cuota: ".$this->getMontoCuota();
        $cadena .="\nMonto Interés: ".$this->getMontoInteres();
        $estado = $this->getCancelada();
        if($estado){
            $cadena .="\nLa cuota se encuentra cancelada";
        }else{
            $cadena .="\nLa cuota NO se encuentra cancelada";
        }
        return $cadena;
    }

    public function darMontoFinalCuota(){
        $montoFinal = $this->getMontoCuota()+$this->getMontoInteres();
        return $montoFinal;
    }
}