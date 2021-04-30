<?php
class Financiera
{
    private $denominacion;
    private $direccionFinanciera;
    private $colObjPrestamosOtorgados;

    public function __construct($pDeno, $pDirF, $pColObjPres)
    {
        $this->denominacion = $pDeno;
        $this->direccionFinanciera = $pDirF;
        $this->colObjPrestamosOtorgados = $pColObjPres;
    }

    public function getDenominacion()
    {
        return $this->denominacion;
    }

    public function getDireccionFinanciera()
    {
        return $this->direccionFinanciera;
    }

    public function getColPrestamosOtorgados()
    {
        return $this->colObjPrestamosOtorgados;
    }

    public function setDenominacion($pDeno)
    {
        $this->denominacion = $pDeno;
    }

    public function setDireccionFinanciera($pDirF)
    {
        $this->direccionFinanciera = $pDirF;
    }

    public function setColPrestamosOtorgados($pColObjPres)
    {
        $this->colObjPrestamosOtorgados = $pColObjPres;
    }

    public function __toString()
    {
        $cadena = "";
        $cadena .= "\nDenominación: " . $this->getDenominacion();
        $cadena .= "\nDirección financiera: " . $this->getDireccionFinanciera();
        $cadena .= "\nPréstamos otorgados: " . $this->mostrarColeccion($this->getColPrestamosOtorgados());
        return $cadena;
    }

    public function mostrarColeccion($col)
    {
        $cadena = "";
        $longitud = count($col);
        for ($i = 0; $i < $longitud; $i++) {
            $cadena .= "\n " . $col[$i];
        }
        return $cadena;
    }

    public function incorporarPrestamo($nuevoPrestamo)
    {
        $colPrestamos = $this->getColPrestamosOtorgados();
        $posicion = count($colPrestamos);
        $colPrestamos[$posicion] = $nuevoPrestamo;
        $this->setColPrestamosOtorgados($colPrestamos);
    }

    public function otorgarPrestamoSiCalifica()
    {
        $colPrestamos = $this->getColPrestamosOtorgados();
        $longitud = count($colPrestamos);
        for ($i = 0; $i < $longitud; $i++) {
            $cuotasGeneradas = count($colPrestamos[$i]->getColCuotas());
            if($cuotasGeneradas == 0){
                $netoDelSolicitante = $colPrestamos[$i]->getObjPersona()->getNeto();
                $monto = $colPrestamos[$i]->getMonto();
                if(($monto/$cuotasGeneradas)<($netoDelSolicitante*0.4)){
                    $colPrestamos[$i]->otorgarPrestamo();
                }
            }
        }
    }

    public function informarCuotaPagar($idPrestamo){
        $refCuota = null;
        $colPrestamos = $this->getColPrestamosOtorgados();
        $longitud = count($colPrestamos);
        $i = 0;
        $encontrado = false;
        while(($i<$longitud)&&(!$encontrado)){
            $idPrestamoBusca = $colPrestamos[$i]->getIdentificacion();
            if($idPrestamoBusca == $idPrestamo){
                $refCuota = $colPrestamos[$i]->darSiguienteCuotaPagar();
                $encontrado = true;
            }
            $i++;
        }
        return $refCuota;
    }
}
