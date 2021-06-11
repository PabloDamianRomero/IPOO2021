<?php
/**
 * PABLO DAMIAN ROMERO - FAI 1652
 */
class Teatro
{
    /**
     * Declaración de variables
     */
    private $id;
    private $nombreTeatro;
    private $direccionTeatro;
    private $colObjFunciones;
    private $mensaje_operacion;

    /**
     * Método constructor
     */
    public function __construct()
    {
        $this->id = 0;
        $this->nombreTeatro = "";
        $this->direccionTeatro = "";
        $this->colObjFunciones = array();
    }

    /**
     * CARGAR
     */
    public function cargar($id, $nombre, $dir, $colFunciones)
    {
        $this->setId($id);
        $this->setNombreTeatro($nombre);
        $this->setDireccionTeatro($dir);
        $this->setColObjFunciones($colFunciones);
    }

    /**
     * Obtiene el valor de id
     */
    public function getId()
    {
        return $this->id;
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
        $unMusical = new Musical();
        $unCine = new Cine();
        $unaObraTeatral = new ObraTeatral();

        $id = $this->getId();

        $cond = "id_teatro=" . $id;
        $colMusical = $unMusical->listar($cond);
        $colCine = $unCine->listar($cond);
        $colObrasTeatrales = $unaObraTeatral->listar($cond);
        $colFunciones = array_merge($colMusical, $colCine, $colObrasTeatrales);
        return $colFunciones;
    }

    /**
     * Obtiene el valor de mensaje_operacion
     */
    public function getmensajeoperacion()
    {
        return $this->mensaje_operacion;
    }

    /**
     * Modifica el valor de id
     */
    public function setId($pId)
    {
        $this->id = $pId;
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

    public function setMensajeOperacion($mensaje_operacion)
    {
        $this->mensaje_operacion = $mensaje_operacion;
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

    /* >>> BUSCAR <<< */
    /**
     * Recupera los datos de un teatro por id
     *
     * @return true en caso de encontrar los datos, false en caso contrario
     */
    public function Buscar($id)
    {
        $base = new BaseDatos();
        $consultaTeatro = "Select * from teatro where id=" . $id;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaTeatro)) {
                if ($row2 = $base->Registro()) {
                    $this->setId($id);
                    $this->setNombreTeatro($row2['nombreTeatro']);
                    $this->setDireccionTeatro($row2['direccionTeatro']);
                    $resp = true;
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    /* >>> LISTAR <<< */
    public function listar($condicion = "")
    {
        $arregloTeatro = null;
        $base = new BaseDatos();
        $consultaTeatro = "Select * from teatro ";
        if ($condicion != "") {
            $consultaTeatro = $consultaTeatro . ' where ' . $condicion;
        }
        $consultaTeatro .= " order by id ";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaTeatro)) {
                $arregloTeatro = array();
                while ($row2 = $base->Registro()) {
                    $id = $row2['id'];
                    $nombreTeatro = $row2['nombreTeatro'];
                    $direccionTeatro = $row2['direccionTeatro'];
                    $arreglo_funciones = array();

                    $teatro = new Teatro();
                    $teatro->cargar($id, $nombreTeatro, $direccionTeatro, $arreglo_funciones);
                    array_push($arregloTeatro, $teatro);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloTeatro;
    }

    /* >>> INSERTAR <<< */
    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO teatro(id, nombreTeatro, direccionTeatro)
				VALUES (" . $this->getId() . ",'" . $this->getNombreTeatro() . "','" . $this->getDireccionTeatro() . "')";

        if ($base->Iniciar()) {

            if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->setId($id);
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    /* >>> MODIFICAR <<< */
    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $consultaModifica = "UPDATE teatro SET nombreTeatro='" . $this->getNombreTeatro() . "',direccionTeatro='" . $this->getDireccionTeatro() . "' WHERE id='" . $this->getId() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModifica)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    /* >>> ELIMINAR <<< */
    public function eliminar()
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM teatro WHERE id=" . $this->getId();
            if ($base->Ejecutar($consultaBorra)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
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
