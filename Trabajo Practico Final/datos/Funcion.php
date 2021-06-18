<?php
# PABLO DAMIAN ROMERO - FAI 1652
class Funcion
{
    /**
     * Declaración de variables
     */
    private $id_funcion;
    private $nombreFuncion;
    private $horaInicio;
    private $duracion;
    private $precioFuncion;
    private $mes;
    private $objTeatro;
    private $mensaje_operacion;

    /**
     * Método constructor
     */
    public function __construct()
    {
        $this->id_funcion = 0;
        $this->nombreFuncion = "";
        $this->horaInicio = "";
        $this->duracion = "";
        $this->precioFuncion = "";
        $this->mes = "";
        $this->objTeatro = null;
    }

    /**
     * Método de carga de datos
     */
    public function cargar($datos)
    {
        $this->setIdFuncion($datos["id_funcion"]);
        $this->setNombreFuncion($datos["nombreFuncion"]);
        $this->setHoraInicio($datos["horaInicio"]);
        $this->setDuracion($datos["duracion"]);
        $this->setPrecioFuncion($datos["precioFuncion"]);
        $this->setMes($datos["mes"]);
        $this->setObjTeatro($datos["objTeatro"]);
    }

    /**
     * Obtiene el valor de id
     */
    public function getIdFuncion()
    {
        return $this->id_funcion;
    }
    /**
     * Obtiene el valor de nombreFuncion
     */
    public function getNombreFuncion()
    {
        return $this->nombreFuncion;
    }

    /**
     * Obtiene el valor de horaInicio
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Obtiene el valor de duracion
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Obtiene el valor de precioFuncion
     */
    public function getPrecioFuncion()
    {
        return $this->precioFuncion;
    }

    /**
     * Obtiene el valor de mes
     */
    public function getMes()
    {
        return $this->mes;
    }

    /**
     * Obtiene el valor de objTeatro
     */
    public function getObjTeatro()
    {
        return $this->objTeatro;
    }

    /**
     * Obtiene el valor de mensaje_operacion
     */
    public function getMensajeOperacion()
    {
        return $this->mensaje_operacion;
    }

    /**
     * Modifica el valor de id_funcion
     */
    public function setIdFuncion($id)
    {
        $this->id_funcion = $id;
    }

    /**
     * Modifica el valor de nombreFuncion
     */
    public function setNombreFuncion($pNombre)
    {
        $this->nombreFuncion = $pNombre;
    }

    /**
     * Modifica el valor de horaInicio
     */
    public function setHoraInicio($pInicio)
    {
        $this->horaInicio = $pInicio;
    }

    /**
     * Modifica el valor de duracion
     */
    public function setDuracion($pDuracion)
    {
        $this->duracion = $pDuracion;
    }

    /**
     * Modifica el valor de precioFuncion
     */
    public function setPrecioFuncion($pPrecio)
    {
        $this->precioFuncion = $pPrecio;
    }

    /**
     * Modifica el valor de mes
     */
    public function setMes($pMes)
    {
        $this->mes = $pMes;
    }

    /**
     * Modifica el valor de objTeatro
     */
    public function setObjTeatro($objTeatro)
    {
        $this->objTeatro = $objTeatro;
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
        $cadena = "";
        $cadena .= "\n\t ~ iD Función: " . $this->getIdFuncion();
        $cadena .= "\n\t ~ Categoría: ".get_class($this);
        $cadena .= "\n\t Nombre de la función: " . $this->getNombreFuncion();
        $cadena .= "\n\t Hora de inicio: " . $this->getHoraInicio();
        $cadena .= "\n\t Duración: " . $this->getDuracion();
        $cadena .= "\n\t Precio: " . $this->getPrecioFuncion();
        $cadena .= "\n\t Mes: " . $this->getMes();
        return $cadena;
    }

    /**
     *  Calcula la duración total de la función
     */
    public function tiempoTotalDeLaFuncion()
    {
        $total = $this->getHoraInicio() + $this->getDuracion();
        return $total;
    }

    /**
     * Devuelve el precio de la función
     */
    public function recibirCosto()
    {
        $costo = $this->getPrecioFuncion();
        return $costo;
    }

#-----------------------------------------------------------------------------------------------------------------------------------------------------------------------
    /**
     * Recupera los datos de una funcion por id
     *
     * @return true en caso de encontrar los datos, false en caso contrario
     */
    public function Buscar($id)
    {
        $base = new BaseDatos();
        $consultaFuncion = "SELECT * FROM funcion WHERE id_funcion=" . $id;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaFuncion)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdFuncion($row2['id_funcion']);
                    $this->setNombreFuncion($row2['nombreFuncion']);
                    $this->setHoraInicio($row2['horaInicio']);
                    $this->setDuracion($row2['duracion']);
                    $this->setPrecioFuncion($row2['precioFuncion']);
                    $this->setMes($row2['mes']);
                    $idTeatro = ($row2['id_teatro']);
                    $objTeatro = new Teatro();
                    $objTeatro->Buscar($idTeatro);
                    $this->setObjTeatro($objTeatro);
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
     * Genera un arreglo con todos los datos de la tabla funcion en la bd
     * según una condición
     */
    public function listar($condicion = "")
    {
        $arregloFuncion = null;
        $base = new BaseDatos();
        $consultaFuncion = "SELECT * FROM funcion ";
        if ($condicion != "") {
            $consultaFuncion = $consultaFuncion . ' WHERE ' . $condicion;
        }
        
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaFuncion)) {
                $arregloFuncion = array();
                while ($row2 = $base->Registro()) {
                    $idFuncion = $row2['id_funcion'];
                    // $idTeatro = $row2['id_teatro']; ESTO YA LO HACE EL BUSCAR DE FUNCION
                    // $objTeatro = new Teatro();
                    // $objTeatro->Buscar($idTeatro, false);
                    $objFuncion = new Funcion();
                    $objFuncion->Buscar($idFuncion);
                    array_push($arregloFuncion, $objFuncion);
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $arregloFuncion;
    }

    /**
     *
     */
    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        $idTeatro = $this->getObjTeatro()->getIdTeatro();
        $consultaInsertar = "INSERT INTO funcion(nombreFuncion, horaInicio, duracion, precioFuncion, mes, id_teatro)
                  VALUES ('" . $this->getNombreFuncion() . "'," . $this->getHoraInicio() . "," . $this->getDuracion() . "," . $this->getPrecioFuncion() . "," . $this->getMes() . "," . $idTeatro . ")";

        if ($base->Iniciar()) {

            if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->setIdFuncion($id);
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
        // Modificar todos los atributos correspondientes
        $consultaModifica = "UPDATE funcion SET id_funcion=".$this->getIdFuncion().",nombreFuncion='" . $this->getNombreFuncion() .
         "',horaInicio=" . $this->getHoraInicio() . ",duracion=" . $this->getDuracion() . ",precioFuncion=" . $this->getPrecioFuncion() . 
         ",mes=" . $this->getMes() . " WHERE id_funcion=" . $this->getIdFuncion() . "";

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
            $consultaBorra = "DELETE FROM funcion WHERE id_funcion=" . $this->getIdFuncion();
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
