<?php
class Tramite
{
    private $nroTramite;
    private $horarioCreacion;
    private $horarioResolucion;
    private $tipoTramite;

    public function __construct($pNro, $pHoraCreacion, $pHoraResolucion, $pTipo)
    {
        $this->nroTramite = $pNro;
        $this->horarioCreacion = $pHoraCreacion;
        $this->horarioResolucion = $pHoraResolucion;
        $this->tipoTramite = $pTipo;
    }

    public function getNroTramite()
    {
        return $this->nroTramite;
    }

    public function getHorarioCreacion()
    {
        return $this->horarioCreacion;
    }

    public function getHorarioResolucion()
    {
        return $this->horarioResolucion;
    }

    public function getTipoTramite()
    {
        return $this->tipoTramite;
    }

    public function setNroTramite($pNro)
    {
        $this->nroTramite = $pNro;
    }

    public function setHorarioCreacion($pHoraCreacion)
    {
        $this->horarioCreacion = $pHoraCreacion;
    }

    public function setHorarioResolucion($pHoraResolucion)
    {
        $this->horarioResolucion = $pHoraResolucion;
    }

    public function setTipoTramite($pTipo)
    {
        $this->tipoTramite = $pTipo;
    }

    public function __toString()
    {
        $cadena = "";
        $cadena .= "\n\t\t\t\t Nro de tramite: " . $this->getNroTramite();
        $cadena .= "\n\t\t\t\t Horario de creación: " . $this->getHorarioCreacion();
        $cadena .= "\n\t\t\t\t Horario de resolución: " . $this->getHorarioResolucion();
        $cadena .= "\n\t\t\t\t Tipo de tramite: " . $this->getTipoTramite();
        return $cadena;
    }
}
