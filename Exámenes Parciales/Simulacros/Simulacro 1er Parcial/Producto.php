<?php
class Producto
{
    private $codigo;
    private $costo;
    private $anioFabricacion;
    private $descripcion;
    private $porcentajeIncrementoAnual;
    private $disponibleVenta;

    public function __construct($pCod, $pCosto, $pAnio, $pDesc, $pPorc, $pActivo)
    {
        $this->codigo = $pCod;
        $this->costo = $pCosto;
        $this->anioFabricacion = $pAnio;
        $this->descripcion = $pDesc;
        $this->porcentajeIncrementoAnual = $pPorc;
        $this->disponibleVenta = $pActivo;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function getCosto()
    {
        return $this->costo;
    }

    public function getAnioFabricacion()
    {
        return $this->anioFabricacion;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getIncrementoAnual()
    {
        return $this->porcentajeIncrementoAnual;
    }

    public function getActivo()
    {
        return $this->disponibleVenta;
    }

    public function setCodigo($pCod)
    {
        $this->codigo = $pCod;
    }

    public function setCosto($pCosto)
    {
        $this->costo = $pCosto;
    }

    public function setAnioFabricacion($pAnio)
    {
        $this->anioFabricacion = $pAnio;
    }

    public function setDescripcion($pDesc)
    {
        $this->descripcion = $pDesc;
    }

    public function setIncrementoAnual($pPorc)
    {
        $this->porcentajeIncrementoAnual = $pPorc;
    }

    public function setActivo($pActivo)
    {
        $this->disponibleVenta = $pActivo;
    }

    public function __toString()
    {
        $cadena = "\n---------Producto---------";
        $cadena .= "\nCodigo: " . $this->getCodigo();
        $cadena .= "\nCosto: " . $this->getCosto();
        $cadena .= "\nAño fabricación: " . $this->getAnioFabricacion();
        $cadena .= "\nDescripción: " . $this->getDescripcion();
        $cadena .= "\nPorcentaje incremento anual: " . $this->getIncrementoAnual();
        if ($this->getActivo()) {
            $cadena .= "\nDisponible para la venta = SI";
        } else {
            $cadena .= "\nDisponible para la venta = NO";
        }
        return $cadena;
    }

    public function darPrecioVenta()
    {
        $_venta = -1;
        if ($this->getActivo()) {
            $diferenciaAnios = date("Y") - $this->getAnioFabricacion();
            $_venta = $this->getCosto() + $this->getCosto() * ($diferenciaAnios * ($this->getIncrementoAnual()/100));
        }
        return $_venta;
    }
}
