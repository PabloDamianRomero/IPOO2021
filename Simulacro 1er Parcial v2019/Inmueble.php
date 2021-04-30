<?php
class Inmueble
{
    private $codigoReferencia;
    private $pisoCorrespondiente;
    private $tipo;
    private $costoMensual;
    private $objPersona; // si se encuentra alquilado

    public function __construct($pCod, $pNroPiso, $pTipo, $pCosto, $pObjPersona)
    {
        $this->codigoReferencia = $pCod;
        $this->pisoCorrespondiente = $pNroPiso;
        $this->tipo = $pTipo;
        $this->costoMensual = $pCosto;
        $this->objPersona = $pObjPersona;
    }

    public function getCodigoReferencia()
    {
        return $this->codigoReferencia;
    }

    public function getNroPiso()
    {
        return $this->pisoCorrespondiente;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getCostoMensual()
    {
        return $this->costoMensual;
    }

    public function getObjPersona()
    {
        return $this->objPersona;
    }

    public function setCodigoReferencia($pCod)
    {
        $this->codigoReferencia = $pCod;
    }

    public function setNroPiso($pNroPiso)
    {
        $this->pisoCorrespondiente = $pNroPiso;
    }

    public function setTipo($pTipo)
    {
        $this->tipo = $pTipo;
    }

    public function setCostoMensual($pCosto)
    {
        $this->costoMensual = $pCosto;
    }

    public function setObjPersona($pObjPersona)
    {
        $this->objPersona = $pObjPersona;
    }

    public function __toString()
    {
        $cadena = "";
        $cadena .= "\nCódigo:         " . $this->getCodigoReferencia();
        $cadena .= "\nNúmero de piso: " . $this->getNroPiso();
        $cadena .= "\nTipo:           " . $this->getTipo();
        $cadena .= "\nCosto Mensual:  " . $this->getCostoMensual();
        $cadena .= "\n--Inquilino:    " . $this->getObjPersona();
        return $cadena;
    }

    public function alquilarInmueble($objPersona)
    {
        $exito = false;
        if ($this->getObjPersona() == null) {
            $this->setObjPersona($objPersona);
            $exito = true;
        }
        return $exito;
    }

}
