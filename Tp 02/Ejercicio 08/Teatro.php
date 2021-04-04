<?php
class Teatro
{
    private $nombreTeatro;
    private $direccionTeatro;
    private $objFunciones;

    public function __construct($nombre, $dir, $pFunciones)
    {
        $this->nombreTeatro = $nombre;
        $this->direccionTeatro = $dir;
        $this->objFunciones = $pFunciones;
    }

    public function getNombreTeatro()
    {
        return $this->nombreTeatro;
    }

    public function getDireccionTeatro()
    {
        return $this->direccionTeatro;
    }

    public function getFunciones()
    {
        return $this->objFunciones;
    }

    public function setNombreTeatro($pNombre)
    {
        $this->nombreTeatro = $pNombre;
    }

    public function setDireccionTeatro($pDir)
    {
        $this->direccionTeatro = $pDir;
    }

    public function setFunciones($pFunciones)
    {
        $this->objFunciones = $pFunciones;
    }

    public function __toString()
    {
        $cadena = "\n===========================================";
        $cadena .= "\nTeatro: " . $this->getNombreTeatro();
        $cadena .= "\nDirección: " . $this->getDireccionTeatro();
        $cadena .= "\n";

        if ($this->getFunciones() != null) {
            $aux = $this->getFunciones();
            $longitud = count($aux);
            for ($i = 0; $i < $longitud; $i++) {
                $cadena .= $aux[$i]->__toString();
            }
            $cadena .= "\n===========================================";
        } else {
            $cadena .= "\nNo existen funciones actualmente\n";
        }
        return $cadena;
    }

    public function cambiarNombreTeatro($nuevoNombre)
    {
        $this->setNombreTeatro($nuevoNombre);
    }

    public function cambiarDireccionTeatro($nuevaDir)
    {
        $this->setDireccionTeatro($nuevaDir);
    }

    public function cambiarNombreFuncion($nroFuncion, $nuevoNombre)
    {
        if ($this->getFunciones() != null) {
            $aux = $this->getFunciones();
            $aux[$nroFuncion]->setNombreFuncion($nuevoNombre);
            $this->setFunciones($aux);
        }
    }

    public function cambiarPrecioFuncion($nroFuncion, $nuevoPrecio)
    {
        if ($this->getFunciones() != null) {
            $aux = $this->getFunciones();
            $aux[$nroFuncion]->setPrecioFuncion($nuevoPrecio);
            $this->setFunciones($aux);
        }
    }
}
