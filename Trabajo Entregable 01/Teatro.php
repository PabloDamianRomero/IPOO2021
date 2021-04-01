<?php
/**
 * PABLO DAMIAN ROMERO - FAI 1652
 *
 * Enlace gitHub: 
 *
 * Un teatro se caracteriza por su nombre y su dirección y en él se realizan 4 funciones al día. 
 * Cada función tiene un nombre y un precio. Realice el diseño de la clase Teatro e indique qué métodos 
 * tendría que tener la clase, teniendo en cuenta que se pueda cambiar el nombre del teatro y la dirección, 
 * el nombre de una función y el precio. 
 * Implementar las 4 funciones usando array de array asociativo. 
 * Cada función es un array asociativo con las claves “nombre” y “precio”.
 * */
class Teatro
{
    private $nombreTeatro;
    private $direccionTeatro;
    private $funciones;

    public function __construct($nombre, $dir, $pFunciones)
    {
        $this->nombreTeatro = $nombre;
        $this->direccionTeatro = $dir;
        $this->funciones = $pFunciones;
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
        return $this->funciones;
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
        $this->funciones = $pFunciones;
    }

    public function __toString()
    {
        $cadena = "";
        $cadena .= "\nTeatro: " . $this->getNombreTeatro();
        $cadena .= "\nDirección: " . $this->getDireccionTeatro();
        $cadena .= "\n";
        if ($this->getFunciones() != null) {
            $longitud = count($this->getFunciones());
            $aux = $this->getFunciones();
            $cont = 0;
            for ($i = 0; $i < $longitud; $i++) {
                $cont++;
                $cadena .= "\nFunción n° " . $cont . ":\n";
                $cadena .= "\tNombre de función: " . $aux[$i]["nombreF"] . "\n";
                $cadena .= "\tPrecio de función: " . $aux[$i]["precioF"];
                $cadena .= "\n";
            }
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
            $aux[$nroFuncion]["nombreF"] = $nuevoNombre;
            $this->setFunciones($aux);
        }
    }

    public function cambiarPrecioFuncion($nroFuncion, $nuevoPrecio)
    {
        if ($this->getFunciones() != null) {
            $aux = $this->getFunciones();
            $aux[$nroFuncion]["precioF"] = $nuevoPrecio;
            $this->setFunciones($aux);
        }
    }
}
