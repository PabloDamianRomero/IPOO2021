<?php
/**
 * PABLO DAMIAN ROMERO - FAI 1652
 * Enlace gitHub:
 */
class Teatro
{
    /**
     * Declaración de variables
     */
    private $nombreTeatro;
    private $direccionTeatro;
    private $colObjFunciones;

    /**
     * Método constructor
     */
    public function __construct($nombre, $dir, $pFunciones)
    {
        $this->nombreTeatro = $nombre;
        $this->direccionTeatro = $dir;
        $this->colObjFunciones = $pFunciones;
    }

    /**
     * Obtiene el valor de nombreTeatro
     */
    public function getNombreTeatro()
    {
        return $this->nombreTeatro;
    }

    /**
     * Obtiene el valor de direccionTeatro
     */
    public function getDireccionTeatro()
    {
        return $this->direccionTeatro;
    }

    /**
     * Obtiene el valor de colObjFunciones
     */
    public function getColObjFunciones()
    {
        return $this->colObjFunciones;
    }

    /**
     * Modifica el valor de nombreTeatro
     */
    public function setNombreTeatro($pNombre)
    {
        $this->nombreTeatro = $pNombre;
    }

    /**
     * Modifica el valor de direccionTeatro
     */
    public function setDireccionTeatro($pDir)
    {
        $this->direccionTeatro = $pDir;
    }

    /**
     * Modifica el valor de colObjFunciones
     */
    public function setColObjFunciones($pFunciones)
    {
        $this->colObjFunciones = $pFunciones;
    }

    /**
     * Devuelve los datos de la clase
     */
    public function __toString()
    {
        $cadena = "\n===========================================";
        $cadena .= "\nTeatro: " . $this->getNombreTeatro();
        $cadena .= "\nDirección: " . $this->getDireccionTeatro();
        $cadena .= "\nFunciones: " . $this->mostrarColeccion($this->getColObjFunciones());
        return $cadena;
    }

    /**
     * Devuelve los datos de una colección
     */
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

    /**
     * Verifica si la colección de objetos funciones no tiene elementos
     */
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

    /**
     * Modifica el valor de nombreTeatro por uno ingresado por parámetro
     */
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

    /**
     * Modifica el valor de direccionTeatro por uno ingresado por parámetro
     */
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

    /**
     * Modifica los valores de un objeto de la clase Funcion
     */
    public function modificarFuncion($nroFuncion, $nuevoNombre, $nuevoPrecio, $nuevaHrInicio, $nuevaDuración)
    {
        $exito = false;
        if (!$this->funcionesEsVacia()) {
            $colActividades = $this->getColObjFunciones();
            $colActividades[$nroFuncion]->setNombreFuncion($nuevoNombre);
            $colActividades[$nroFuncion]->setPrecioFuncion($nuevoPrecio);
            $colActividades[$nroFuncion]->setHoraInicio($nuevaHrInicio);
            $colActividades[$nroFuncion]->setDuracion($nuevaDuración);
            $this->setColObjFunciones($colActividades);
            $exito = true;
        }
        return $exito;
    }

    /**
     * Método que verifica el horario de una nueva función a ingresar con la última función ingresada.
     * (Esto se ejecuta antes de crear la nueva funcion)
     */
    public function horarioSePisa($nuevaDuración)
    {
        $estado = false;
        $ultimaHora = $this->ultimaHora();
        if (($ultimaHora >= $nuevaDuración)) {
            $estado = true;
        }
        return $estado;
    }

    /**
     * Método que retorna el tiempo total de la última función agregada.
     * Esto es, horaInicio + duración de la misma. (Implementado en clase Función)
     */
    public function ultimaHora()
    {
        $ultHora = -1;
        $colFunciones = $this->getColObjFunciones();
        if (count($colFunciones) != 0) {
            $ultHora = $colFunciones[count($colFunciones) - 1]->tiempoTotalDeLaFuncion();
        }
        return $ultHora;
    }

    /**
     * Verifica si un horario está dentro del rango de un día
     */
    public function correspondeAUnDia($tiempo)
    {
        $respuesta = false;
        if ($tiempo >= 0 && $tiempo <= 23) {
            $respuesta = true;
        }
        return $respuesta;
    }

    /**
     * Determina según las actividades del teatro cuál debería ser el cobro obtenido.
     */
    public function darCostos($mesFiltro)
    {
        $costos = 0;
        $colActividades = $this->getColObjFunciones();
        $longitud = count($colActividades);
        for ($i = 0; $i < $longitud; $i++) {
            if ($colActividades[$i]->getMes() == $mesFiltro) {
                $costos = $costos + $colActividades[$i]->recibirCosto();
            }
        }
        return $costos;
    }
}
