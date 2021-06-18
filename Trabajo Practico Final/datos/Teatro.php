<?php
# PABLO DAMIAN ROMERO - FAI 1652
class Teatro
{
    /**
     * Declaración de variables
     */
    private $id_teatro;
    private $nombreTeatro;
    private $direccionTeatro;
    private $colObjFunciones;
    private $mensaje_operacion;

    /**
     * Método constructor
     */
    public function __construct()
    {
        $this->id_teatro = 0;
        $this->nombreTeatro = "";
        $this->direccionTeatro = "";
        $this->colObjFunciones = array();
    }

    /**
     * Método de carga de datos
     */
    public function cargar($id_teatro, $nombre, $dir, $colFunciones)
    {
        $this->setIdTeatro($id_teatro);
        $this->setNombreTeatro($nombre);
        $this->setDireccionTeatro($dir);
        $this->setColObjFunciones($colFunciones);
    }

    /**
     * Obtiene el valor de id_teatro
     */
    public function getIdTeatro()
    {
        return $this->id_teatro;
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
        $coleccion = array();
        $condicion = "id_Teatro=" . $this->getIdTeatro();
        $objFuncion = new Funcion();
        $colFunciones = $objFuncion->listar($condicion); // Obtengo las funciones con el id_teatro
        $objCine = new Cine();
        $objObraTeatral = new ObraTeatral();
        $objMusical = new Musical();
        for ($i = 0; $i < (count($colFunciones)); $i++) {
            //Recorre todos los id de la coleccion y busca las especializaciones que tienen el id como clave foranea
            $idFuncion = $colFunciones[$i]->getIdFuncion();
            $condicion = "id_funcion=" . $idFuncion;
            if (($obj = $objCine->listar($condicion)) != []) { // Para no guardar arreglos vacios
                array_push($coleccion, $obj[0]); // Arreglo con un solo objeto
            }
            if (($obj = $objObraTeatral->listar($condicion)) != []) {
                array_push($coleccion, $obj[0]);
            }
            if (($obj = $objMusical->listar($condicion)) != []) {
                array_push($coleccion, $obj[0]);
            }
        }
        return $coleccion;
    }

    /**
     * Obtiene el valor de mensaje_operacion
     */
    public function getMensajeOperacion()
    {
        return $this->mensaje_operacion;
    }

    /**
     * Modifica el valor de id
     */
    public function setIdTeatro($pId)
    {
        $this->id_teatro = $pId;
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
     * Modifica el valor de mensaje_operacion
     */
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
        $cadena .= "\niD Teatro: " . $this->getIdTeatro();
        $cadena .= "\nTeatro: " . $this->getNombreTeatro();
        $cadena .= "\nDirección: " . $this->getDireccionTeatro();
        $cadena .= "\nFunciones: " . $this->mostrarColeccion($this->getColObjFunciones());
        return $cadena;
    }

    /**
     * Devuelve los datos de una colección
     */
    private function mostrarColeccion($unaCol)
    {
        $cadena = "";
        $longitud = count($unaCol);
        for ($i = 0; $i < $longitud; $i++) {
            $cadena .= "\n ------------- Función -------------" . $unaCol[$i];
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
     * Busca una funcion por su id, en la coleccion de funciones de teatro
     * y si existe, devuelve el nombre de la clase a la que pertenece esa
     * función
     */
    public function buscarFuncionEnColLocal($idBuscaFuncion)
    {
        $colFunciones = $this->getColObjFunciones();
        $largoColFunciones = count($colFunciones);
        $i = 0;
        $encontrado = false;
        $nombreClase = "";
        while (($i < $largoColFunciones) && (!$encontrado)) {
            if ($colFunciones[$i]->getIdFuncion() == $idBuscaFuncion) {
                $encontrado = true;
                $nombreClase = get_class($colFunciones[$i]);
            }
            $i++;
        }
        return $nombreClase;
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

    #-----------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ----- ORM ------
    /**
     * Recupera los datos de un teatro por id_teatro
     * @param int $id
     * @return true en caso de encontrar los datos, false en caso contrario
     */
    public function Buscar($id)
    {
        $base = new BaseDatos();
        $consultaTeatro = "SELECT * FROM teatro WHERE id_teatro=" . $id;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaTeatro)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdTeatro($id);
                    $this->setNombreTeatro($row2['nombreTeatro']);
                    $this->setDireccionTeatro($row2['direccionTeatro']);
                    $coleccion = array();
                    $this->setColObjFunciones($coleccion);
                    $resp = true;
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    /**
     * Genera un arreglo con todos los datos de la tabla teatro en la bd
     * según una condición
     */
    public function listar($condicion = "")
    {
        $arregloTeatro = null;
        $base = new BaseDatos();
        $consultaTeatro = "SELECT * FROM teatro ";
        if ($condicion != "") {
            $consultaTeatro = $consultaTeatro . ' WHERE ' . $condicion;
        }

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaTeatro)) {
                $arregloTeatro = array();
                while ($row2 = $base->Registro()) {
                    $id = $row2['id_teatro'];
                    $teatro = new Teatro();
                    $teatro->Buscar($id);
                    array_push($arregloTeatro, $teatro);
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $arregloTeatro;
    }

    /**
     *
     */
    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;

        $consultaInsertar = "INSERT INTO teatro(nombreTeatro, direccionTeatro)
        VALUES ('" . $this->getNombreTeatro() . "','" . $this->getDireccionTeatro() . "')";

        if ($base->Iniciar()) {
            if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->setIdTeatro($id);
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    /**
     *
     */
    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $consultaModifica = "UPDATE teatro SET id_teatro=" . $this->getIdTeatro() . ", nombreTeatro='" . $this->getNombreTeatro() . 
        "',direccionTeatro='" . $this->getDireccionTeatro() . "' WHERE id_teatro='" . $this->getIdTeatro() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModifica)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    /**
     *
     */
    public function eliminar()
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM teatro WHERE id_teatro=" . $this->getIdTeatro();
            if ($base->Ejecutar($consultaBorra)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }
}
