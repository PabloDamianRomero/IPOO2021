<?php
class Empresa
{

    private $denominacion;
    private $direccion;
    private $colObjClientes;
    private $colObjProductos;
    private $colObjVentas;

    public function __construct($pDenominacion, $pDir, $pClientes, $pProductos, $pVentas)
    {
        $this->denominacion = $pDenominacion;
        $this->direccion = $pDir;
        $this->colObjClientes = $pClientes;
        $this->colObjProductos = $pProductos;
        $this->colObjVentas = $pVentas;
    }

    public function getDenominacion()
    {
        return $this->denominacion;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getClientes()
    {
        return $this->colObjClientes;
    }

    public function getProductos()
    {
        return $this->colObjProductos;
    }

    public function getVentas()
    {
        return $this->colObjVentas;
    }

    public function setDenominacion($pDenominacion)
    {
        $this->denominacion = $pDenominacion;
    }

    public function setDireccion($pDir)
    {
        $this->direccion = $pDir;
    }

    public function setClientes($pClientes)
    {
        $this->colObjClientes = $pClientes;
    }

    public function setProductos($pProductos)
    {
        $this->colObjProductos = $pProductos;
    }

    public function setVentas($pVentas)
    {
        $this->colObjVentas = $pVentas;
    }

    public function __toString()
    {
        $cadena = "";
        $cadena .= "\nDenominación: " . $this->getDenominacion();
        $cadena .= "\nDirección: " . $this->getDireccion();
        $cadena .= "\n\n------------Clientes:------------";
        $colClientes = $this->getClientes();
        for ($i = 0; $i < count($colClientes); $i++) {
            $cadena .= "\n" . $colClientes[$i];
        }
        $cadena .= "\n\n------------Productos:------------";
        $colProductos = $this->getProductos();
        for ($i = 0; $i < count($colProductos); $i++) {
            $cadena .= "\n" . $colProductos[$i];
        }
        $cadena .= "\n\n------------Ventas:------------";
        $colVentas = $this->getVentas();
        for ($i = 0; $i < count($colVentas); $i++) {
            $cadena .= "\n" . $colVentas[$i];
        }
        return $cadena;
    }

    public function retornarVeiculo($codigoProducto)
    {
        $referencia = null;
        if ($this->getProductos() != null) {
            $colProductos = $this->getProductos();
            $longitud = count($colProductos);
            $i = 0;
            $seguir = true;
            while (($i < $longitud) && ($seguir)) {
                if ($colProductos[$i]->getCodigo() == $codigoProducto) {
                    $referencia = $colProductos[$i];
                    $seguir = false;
                } else {
                    $i++;
                }
            }
        }
        return $referencia;
    }

    public function registrarVenta($colCodigosProductos, $objCliente)
    {
        $importeFinal = 0;
        if ($objCliente->getEstadoBaja() == "n") {
            $longitud = count($colCodigosProductos);
            $nuevaVenta = new Venta(count($this->getVentas()), date("d") . "/" . date("m") . "/" . date("Y"), $objCliente, array(), 0);
            for ($i = 0; $i < $longitud; $i++) {
                $referencia = $this->retornarVeiculo($colCodigosProductos[$i]);
                if ($referencia != null && $referencia->getActivo()) {
                    $importeFinal = $nuevaVenta->incorporarProducto($referencia);
                }
            }
            $colVentaNueva = $this->getVentas();
            $posicion = count($colVentaNueva);
            $colVentaNueva[$posicion] = $nuevaVenta;
            $this->setVentas($colVentaNueva);
        }
        return $importeFinal;
    }

    public function retornarVentasXCliente($tipo, $numDoc)
    {
        $coleccionDeVentas = array();
        if ($this->getVentas() != null) {
            $ventasDisponibles = $this->getVentas();
            $longitud = count($ventasDisponibles);
            $posicion = 0;
            for ($i = 0; $i < $longitud; $i++) {
                if (($ventasDisponibles[$i]->getCliente()->getTipoDocumento() == $tipo) && ($ventasDisponibles[$i]->getCliente()->getNroDocumento() == $numDoc)) {
                    $coleccionDeVentas[$posicion] = $ventasDisponibles[$i];
                    $posicion++;
                }
            }
        }
        return $coleccionDeVentas;
    }

}
