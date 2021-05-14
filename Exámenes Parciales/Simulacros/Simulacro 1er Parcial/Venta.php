<?php
class Venta
{
    private $numero;
    private $fechaVenta;
    private $objCliente;
    private $colObjProductos;
    private $precioFinal;

    public function __construct($pNum, $pFecha, $pCliente, $pProductos, $pPrecioFinal)
    {
        $this->numero = $pNum;
        $this->fechaVenta = $pFecha;
        $this->objCliente = $pCliente;
        $this->colObjProductos = $pProductos;
        $this->precioFinal = $pPrecioFinal;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function getFechaVenta()
    {
        return $this->fechaVenta;
    }

    public function getCliente()
    {
        return $this->objCliente;
    }

    public function getProductos()
    {
        return $this->colObjProductos;
    }

    public function getPrecioFinal()
    {
        return $this->precioFinal;
    }

    public function setNumero($pNum)
    {
        $this->numero = $pNum;
    }

    public function setFechaVenta($pFecha)
    {
        $this->fechaVenta = $pFecha;
    }

    public function setCliente($pCliente)
    {
        $this->objCliente = $pCliente;
    }

    public function setProductos($pProductos)
    {
        $this->colObjProductos = $pProductos;
    }

    public function setPrecioFinal($pPrecioFinal)
    {
        $this->precioFinal = $pPrecioFinal;
    }

    public function __toString()
    {
        $cadena = "";
        $cadena .= "\nNúmero de venta: " . $this->getNumero();
        $cadena .= "\nFecha de venta: " . $this->getFechaVenta();
        $cadena .= "\nCliente: " . $this->getCliente();
        if ($this->getProductos() != null) {
            $colProductos = $this->getProductos();
            $longitud = count($colProductos);
            for ($i = 0; $i < $longitud; $i++) {
                $cadena .= "\n\t" . $colProductos[$i];
            }
        } else {
            $cadena .= "\nNo existen productos";
        }
        $cadena .= "\nPrecio final: " . $this->getPrecioFinal();
        return $cadena;
    }

    public function incorporarProducto($objProducto)
    {
        $nuevoPrecio = 0;
        if (($objProducto->getActivo()) && ($objProducto->darPrecioVenta() > 0)) {
            $nuevaColProductos = $this->getProductos();
            $longitud = count($nuevaColProductos);
            $nuevaColProductos[$longitud] = $objProducto;
            $this->setProductos($nuevaColProductos);
            $nuevoPrecio = $this->getPrecioFinal() + $objProducto->darPrecioVenta();
            $this->setPrecioFinal($nuevoPrecio);
        }
        return $nuevoPrecio;
    }

}
