<?php
class Disquera
{
    private $horaDesde;
    private $horaHasta;
    private $estado;
    private $direccion;
    private $objDuenio;

    public function __construct($pHoraDesde, $pHoraHasta, $pEstado, $pDir, $pObjDuenio)
    {
        $this->horaDesde = $pHoraDesde;
        $this->horaHasta = $pHoraHasta;
        $this->estado = $pEstado;
        $this->direccion = $pDir;
        $this->objDuenio = $pObjDuenio;
    }

    public function getHoraDesde()
    {
        return $this->horaDesde;
    }

    public function getHoraHasta()
    {
        return $this->horaHasta;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getDuenio()
    {
        return $this->objDuenio;
    }

    public function setHoraDesde($pHoraDesde)
    {
        $this->horaDesde = $pHoraDesde;
    }

    public function setHoraHasta($pHoraHasta)
    {
        $this->horaHasta = $pHoraHasta;
    }

    public function setEstado($pEstado)
    {
        $this->estado = $pEstado;
    }

    public function setDireccion($pDir)
    {
        $this->direccion = $pDir;
    }

    public function setDuenio($pObjDuenio)
    {
        $this->objDuenio = $pObjDuenio;
    }

    public function __toString()
    {
        $cadena = "";
        $cadena = $cadena . "\nAbre: " . $this->getHoraDesde()[0]["H"] . "hs:" . $this->getHoraDesde()[0]["M"] . "min";
        $cadena = $cadena . "\nCierra: " . $this->getHoraHasta()[0]["H"] . "hs:" . $this->getHoraDesde()[0]["M"] . "min";
        $cadena = $cadena . "\nEstado: " . $this->getEstado();
        $cadena = $cadena . "\nDirección: " . $this->getDireccion();
        $cadena = $cadena . "\n----------Dueño----------" . $this->getDuenio();
        return $cadena;
    }

    public function dentroHorarioAtencion($hora, $minutos)
    {
        $respuesta = false;
        if ($this->validarHorario()) {
            $hsInicio = $this->getHoraDesde()[0]["H"];
            $minInicio = $this->getHoraDesde()[0]["M"];
            $hsCierre = $this->getHoraHasta()[0]["H"];
            $minCierre = $this->getHoraHasta()[0]["M"];
            if (($hora >= $hsInicio) && ($hora <= $hsCierre)) {
                if ($minInicio < $minCierre) {
                    echo "\nCASO 1";
                    if(($minutos>=$minInicio)&&($minutos<=$minCierre)){
                        $respuesta = true;
                    }
                } elseif ($minInicio > $minCierre) {
                    echo "\nCASO 2";
                }
            }
        }
        return $respuesta;
    }

    public function validarHorario()
    {
        $respuesta = false;
        $hsInicio = $this->getHoraDesde()[0]["H"];
        $minInicio = $this->getHoraDesde()[0]["M"];
        $hsCierre = $this->getHoraHasta()[0]["H"];
        $minCierre = $this->getHoraHasta()[0]["M"];
        if (($hsInicio >= 0) && ($hsInicio <= 23) && ($minInicio >= 0) && ($minInicio <= 59) && ($hsCierre >= 0) && ($hsCierre <= 23) && ($minCierre >= 0) && ($minCierre <= 59)) {
            $respuesta = true;
        }
        return $respuesta;
    }
}
