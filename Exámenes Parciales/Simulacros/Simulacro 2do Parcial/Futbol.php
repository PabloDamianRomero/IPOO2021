<?php
class Futbol extends Partido
{

    public function __construct($pObjEquipo1, $pObjEquipo2, $pFecha, $pCantGolesE1, $pCantGolesE2)
    {
        parent::__construct($pObjEquipo1, $pObjEquipo2, $pFecha, $pCantGolesE1, $pCantGolesE2);
    }

    public function coeficientePartido()
    {
        $coef = parent::coeficientePartido();
        $descripcionCategoria = $this->getObjEquipo1()->getObjCategoria()->getDescripcion(); // Si el partido existe, la categoria de ambos equipos es la misma
        switch ($descripcionCategoria) {
            case "Menores":
                $coefCat = 0.11;
                break;
            case "Juveniles":
                $coefCat = 0.17;
                break;
            case "Mayores":
                $coefCat = 0.23;
                break;
        }
        $coefFutbol = $coef + ($coef * $coefCat);
        return $coefFutbol;
    }
}
