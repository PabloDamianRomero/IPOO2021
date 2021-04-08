<?php
/**
 * PABLO DAMIAN ROMERO - FAI 1652
 *
 * Enlace gitHub: https://github.com/PabloDamianRomero/IPOO2021.git
 * 
 * Nombre de la carpeta en el repositorio: Trabajo Entregable 02
 *
 * 
 * Modificar la clase Teatro (Ejercicio 15 TP 1) para que ahora las funciones sean un objeto 
 * que tenga las variables nombre, horario de inicio, duración de la obra y precio.
 * El teatro ahora, contiene una referencia a una colección de objetos de la clase  Funciones; las cuales pueden variar en cantidad y en horario.
 * Volver a implementar las operaciones que permiten modificar el nombre y el precio de una función. 
 * Luego implementar la operación que carga las funciones de un teatro, solicitando por consola la información de las mismas. 
 * También se debe verificar que el horario de las funciones, no se solapen para un mismo teatro.
 * */
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

        if (!$this->funcionesEsVacia()) {
            $aux = $this->getFunciones();
            $longitud = count($aux);
            for ($i = 0; $i < $longitud; $i++) {
                $cadena .= $aux[$i];
            }
            $cadena .= "\n===========================================";
        } else {
            $cadena .= "\nNo existen funciones actualmente\n";
        }
        return $cadena;
    }

    public function funcionesEsVacia()
    {
        $respuesta = false;
        if ($this->getFunciones() == null) {
            $respuesta = true;
        }
        return $respuesta;
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
        if (!$this->funcionesEsVacia()) {
            $aux = $this->getFunciones();
            $aux[$nroFuncion]->setNombreFuncion($nuevoNombre);
            $this->setFunciones($aux);
        }
    }

    public function cambiarPrecioFuncion($nroFuncion, $nuevoPrecio)
    {
        if (!$this->funcionesEsVacia()) {
            $aux = $this->getFunciones();
            $aux[$nroFuncion]->setPrecioFuncion($nuevoPrecio);
            $this->setFunciones($aux);
        }
    }
}
