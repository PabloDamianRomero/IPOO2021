<?php
/**
 * Coreccion tpo 2
 *
 * DESAPROBADO
 * No Define un método especial para modificar los datos de 1 función

 * El método encargado de cargar las funciones, tiene que verificar el horario antes de cargar la misma. Recordar que el Test no debe implementar funcionalidad solicitada para los objetos.
 * El método que modifica la información de una función, no permite modificar el horario de la función que se desea modificar.
 * OJO, al modificar una función, se debe modificar el array de funciones del teatro usando el SET correspondiente.
 */
class Teatro
{
    private $nombreTeatro;
    private $direccionTeatro;
    private $colObjFunciones;

    public function __construct($nombre, $dir, $pFunciones)
    {
        $this->nombreTeatro = $nombre;
        $this->direccionTeatro = $dir;
        $this->colObjFunciones = $pFunciones;
    }

    public function getNombreTeatro()
    {
        return $this->nombreTeatro;
    }

    public function getDireccionTeatro()
    {
        return $this->direccionTeatro;
    }

    public function getColObjFunciones()
    {
        return $this->colObjFunciones;
    }

    public function setNombreTeatro($pNombre)
    {
        $this->nombreTeatro = $pNombre;
    }

    public function setDireccionTeatro($pDir)
    {
        $this->direccionTeatro = $pDir;
    }

    public function setColObjFunciones($pFunciones)
    {
        $this->colObjFunciones = $pFunciones;
    }

    public function __toString()
    {
        $cadena = "\n===========================================";
        $cadena .= "\nTeatro: " . $this->getNombreTeatro();
        $cadena .= "\nDirección: " . $this->getDireccionTeatro();
        $cadena .= "\nFunciones: " . $this->mostrarColeccion($this->getColObjFunciones());
        return $cadena;
    }

    public function mostrarColeccion($unaCol)
    {
        $cadena = "";
        $longitud = count($unaCol);
        for ($i = 0; $i < $longitud; $i++) {
            $cadena .= "\n ------------- Función " . $i . " -------------" . $unaCol[$i];
            $cadena .= "\n---------------------------------------\n";
        }
        return $cadena;
    }

    public function funcionesEsVacia()
    {
        $esVacia = false;
        $colFunciones = $this->getColObjFunciones();
        $longitud = count($colFunciones);
        if ($longitud == 0) {
            $esVacia = true;
        }
        return $esVacia;
    }

    public function cambiarNombreTeatro($nuevoNombre)
    {
        $exito = false;
        $anterior = $this->getNombreTeatro();
        if ($anterior != $nuevoNombre) {
            $this->setNombreTeatro($nuevoNombre);
            $exito = true;
        }
        return $exito;
    }

    public function cambiarDireccionTeatro($nuevaDir)
    {
        $exito = false;
        $anterior = $this->getDireccionTeatro();
        if ($anterior != $nuevaDir) {
            $this->setDireccionTeatro($nuevaDir);
            $exito = true;
        }
        return $exito;
    }

    /**
     * Método que verifica si existe la funcion con nombre pasado por parametro
     * Si existe, devuelve su posicion del arreglo
     */
    public function buscarFuncion($nombreFuncion)
    {
        $posicion = -1;
        if (!$this->funcionesEsVacia()) {
            $colFunciones = $this->getColObjFunciones();
            $longitud = count($colFunciones);
            $seguir = true;
            $i = 0;
            while (($i < $longitud) && ($seguir)) {
                if ($colFunciones[$i]->getNombreFuncion() == $nombreFuncion) {
                    $posicion = $i;
                    $seguir = false;
                }
                $i++;
            }
        }
        return $posicion;
    }

    public function cambiarNombreFuncion($nroFuncion, $nuevoNombre)
    {
        $exito = false;
        if (!$this->funcionesEsVacia()) {
            $aux = $this->getColObjFunciones();
            $aux[$nroFuncion]->setNombreFuncion($nuevoNombre);
            $this->setColObjFunciones($aux);
            $exito = true;
        }
        return $exito;
    }

    public function cambiarPrecioFuncion($nroFuncion, $nuevoPrecio)
    {
        $exito = false;
        if (!$this->funcionesEsVacia()) {
            $aux = $this->getColObjFunciones();
            $aux[$nroFuncion]->setPrecioFuncion($nuevoPrecio);
            $this->setColObjFunciones($aux);
            $exito = true;
        }
        return $exito;
    }

    /**
     * Método que verifica el horario de una nueva función a ingresar
     * con la última función ingresada
     * (Esto se ejecuta antes de crear la nueva funcion)
     */
    public function horarioSePisa($nuevaDuración)
    {
        $estado = false;
        $ultimaHora = $this->ultimaHora();
        //echo "\nULT HS: " . $ultimaHora;
        if (($ultimaHora >= $nuevaDuración)) {
            $estado = true;
        }
        return $estado;
    }

    public function ultimaHora()
    {
        $ultHora = -1;
        $colFunciones = $this->getColObjFunciones();
        if (count($colFunciones) != 0) {
            $ultHora = $colFunciones[count($colFunciones) - 1]->tiempoTotalDeLaFuncion();
        }
        return $ultHora;
    }

    public function correspondeAUnDia($tiempo)
    {
        $respuesta = false;
        if ($tiempo >= 0 && $tiempo <= 23) {
            $respuesta = true;
        }
        return $respuesta;
    }
}
