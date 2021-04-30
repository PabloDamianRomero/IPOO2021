<?php
class Edificio
{
    private $direccion;
    private $objPersona;
    private $colObjInmueble;

    public function __construct($pDir, $pObjPersona, $pColObjInm)
    {
        $this->direccion = $pDir;
        $this->objPersona = $pObjPersona;
        $this->colObjInmueble = $pColObjInm;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getObjPersona()
    {
        return $this->objPersona;
    }

    public function getColObjInmueble()
    {
        return $this->colObjInmueble;
    }

    public function setDireccion($pDir)
    {
        $this->direccion = $pDir;
    }

    public function setObjPersona($pObjPersona)
    {
        $this->objPersona = $pObjPersona;
    }

    public function setColObjInmueble($pColObjInm)
    {
        $this->colObjInmueble = $pColObjInm;
    }

    public function __toString()
    {
        $cadena = "";
        $cadena .= "\nDirección:         " . $this->getDireccion();
        $cadena .= "\n--Persona:         " . $this->getObjPersona();
        $cadena .= "\n--ColInmuebles:    " . $this->mostrarColeccion($this->getColObjInmueble());
        return $cadena;
    }

    public function mostrarColeccion($unaCol)
    {
        $cadena = "";
        $longitud = count($unaCol);
        for ($i = 0; $i < $longitud; $i++) {
            $cadena .= "\n* " . $unaCol[$i];
        }
        return $cadena;
    }

    public function darInmueblesDisponiblesParaAlquiler($unTipoInmueble, $costoMensual)
    {
        $colInmuebleDisp = array();
        $colInmuebleTotal = $this->getColObjInmueble();
        $longitud = count($colInmuebleTotal);
        for ($i = 0; $i < $longitud; $i++) {
            $tipo = $colInmuebleTotal[$i]->getTipo();
            $costo = $colInmuebleTotal[$i]->getCostoMensual();
            $inquilino = $colInmuebleTotal[$i]->getObjPersona();
            if (($tipo == $unTipoInmueble) && ($costoMensual < $costo) && ($inquilino == null)) {
                $colInmuebleDisp[count($colInmuebleDisp)] = $colInmuebleTotal[$i];
            }
        }
        return $colInmuebleDisp;
    }

    public function registrarAlquilerInmueble($objInmueble, $objPersona){
        $exito = $objInmueble->alquilarInmueble($objPersona);
        return $exito;
    }

    public function verificarPoliticaDeEmpresa($objInmueble){
        $exito = true;
        $totalInmuebles = $this->getColObjInmueble();
        $longitud = count($totalInmuebles);
        $ultimoTipo = $objInmueble->getTipo();
        $ultimoPiso = $objInmueble->getNroPiso();
        $i=0;
        while(($i<$longitud) && ($exito)){
            $objDepartamento = $totalInmuebles[$i];
            $tipoActual = $objDepartamento->getTipo();
            $pisoActual = $objDepartamento->getNroPiso();
            $inquilino = $objDepartamento->getObjPersona();
            if(($ultimoTipo==$tipoActual)&&($ultimoPiso>$pisoActual)&&($inquilino==null)){
                $exito = false;
            }
            $i++;
        }
    }

    public function calculaCostoEdificio(){
        $total = 0;
        $colInmuebleTotal = $this->getColObjInmueble();
        foreach ($colInmuebleTotal as $objInm) {
            if($objInm->getObjPersona() != null){
                $total += $objInm->getCostoMensual();
            }
        }
        return $total;
    }
}
