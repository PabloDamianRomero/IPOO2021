<?php
class Basket extends Partido{
    private $cantInfracciones;

    public function __construct($pObjEquipo1, $pObjEquipo2, $pFecha,$pCantInf, $pCantGolesE1, $pCantGolesE2){
        parent::__construct($pObjEquipo1, $pObjEquipo2, $pFecha, $pCantGolesE1, $pCantGolesE2);
        $this->cantInfracciones = $pCantInf;
    }

    public function setCantInfracciones($pCantInf)
    {
        $this->cantInfracciones = $pCantInf;
    }

    public function getCantInfracciones()
    {
        return $this->cantInfracciones;
    }

    public function coeficientePartido()
    {
        $coef = parent::coeficientePartido();
        $coef = $coef - (0.75 * $this->getCantInfracciones());
        return $coef;
    }

}