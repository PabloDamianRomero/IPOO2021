<?php
/**
 * PABLO DAMIAN ROMERO - FAI 1652
 */
class Funcion
{
    /**
     * Declaración de variables
     */
    private $id;
    private $nombreFuncion;
    private $horaInicio;
    private $duracion;
    private $precioFuncion;
    private $mes;
    private $tipo;
    private $id_teatro;
    private $mensaje_operacion;

    /**
     * Método constructor
     */
    public function __construct()
    {
        $this->id = 0;
        $this->nombreFuncion = "";
        $this->horaInicio = "";
        $this->duracion = "";
        $this->precioFuncion = "";
        $this->mes = "";
        $this->tipo = "";
        $this->id_teatro = "";
    }

    // /* >>> CARGAR <<< */
    // public function cargar($pId, $pNombre, $pInicio, $pDuracion, $pPrecio, $pMes, $pTipo, $pIdTeatro)
    // {
    //     $this->setId($pId);
    //     $this->setNombreFuncion($pNombre);
    //     $this->setHoraInicio($pInicio);
    //     $this->setDuracion($pDuracion);
    //     $this->setPrecioFuncion($pPrecio);
    //     $this->setMes($pMes);
    //     $this->setTipo($pTipo);
    //     $this->setId_teatro($pIdTeatro);
    // }

    /* >>> CARGAR <<< */
    public function cargar($datos)
    {
        $this->setId($datos["id"]);
        $this->setNombreFuncion($datos["nombre"]);
        $this->setHoraInicio($datos["horaInicio"]);
        $this->setDuracion($datos["duracion"]);
        $this->setPrecioFuncion($datos["precio"]);
        $this->setMes($datos["mes"]);
        $this->setTipo($datos["tipo"]);
        $this->setId_teatro($datos["id_teatro"]);
    }

    /**
     * Get declaración de variables
     */
    public function getId()
    {
        return $this->id;
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
     * Get the value of tipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Get the value of id_teatro
     */
    public function getId_teatro()
    {
        return $this->id_teatro;
    }

    /**
     * Get the value of mensaje_operacion
     */
    public function getMensaje_operacion()
    {
        return $this->mensaje_operacion;
    }

    /**
     * Set declaración de variables
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * Set the value of tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * Set the value of id_teatro
     */
    public function setId_teatro($id_teatro)
    {
        $this->id_teatro = $id_teatro;
    }

    /**
     * Set the value of mensaje_operacion
     */
    public function setMensaje_operacion($mensaje_operacion)
    {
        $this->mensaje_operacion = $mensaje_operacion;
    }

    /**
     * Devuelve los datos de la clase
     */
    public function __toString()
    {
        $cadena = "";
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

    /* >>> BUSCAR <<< */
    /**
     * Recupera los datos de una funcion por id
     *
     * @return true en caso de encontrar los datos, false en caso contrario
     */
    public function Buscar($id)
    {
        $base = new BaseDatos();
        $consultaFuncion = "Select * from funcion where id=" . $id;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaFuncion)) {
                if ($row2 = $base->Registro()) {
                    $this->setId($id);
                    $this->setNombreFuncion($row2['nombreFuncion']);
                    $this->setHoraInicio($row2['horaInicio']);
                    $this->setDuracion($row2['duracion']);
                    $this->setPrecioFuncion($row2['precioFuncion']);
                    $this->setMes($row2['mes']);
                    $this->setTipo($row2['tipo']);
                    $this->setId_teatro($row2['id_teatro']);
                    $resp = true;
                }
            } else {
                $this->setMensaje_operacion($base->getError());
            }
        } else {
            $this->setMensaje_operacion($base->getError());
        }
        return $resp;
    }

    /* >>> LISTAR <<< */
    public function listar($condicion = "")
    {
        $arregloFuncion = null;
        $base = new BaseDatos();
        $consultaFuncion = "Select * from funcion ";
        if ($condicion != "") {
            $consultaFuncion = $consultaFuncion . ' where ' . $condicion;
        }
        $consultaFuncion .= " order by nombreFuncion ";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaFuncion)) {
                $arregloFuncion = array();
                while ($row2 = $base->Registro()) {
                    $id = $row2['id'];
                    $nombreFuncion = $row2['nombreFuncion'];
                    $horaInicio = $row2['horaInicio'];
                    $duracion = $row2['duracion'];
                    $precioFuncion = $row2['precioFuncion'];
                    $mes = $row2['mes'];
                    $tipo = $row2['tipo'];
                    $id_teatro = $row2['id_teatro'];

                    $func = new Funcion();
                    $nuevosDatos = array();
                    $nuevosDatos["id"] = $id;
                    $nuevosDatos["nombre"] = $nombreFuncion;
                    $nuevosDatos["horaInicio"] = $horaInicio;
                    $nuevosDatos["duracion"] = $duracion;
                    $nuevosDatos["precio"] = $precioFuncion;
                    $nuevosDatos["mes"] = $mes;
                    $nuevosDatos["tipo"] = $tipo;
                    $nuevosDatos["id_teatro"] = $id_teatro;
                    $func->cargar($nuevosDatos);
                    array_push($arregloFuncion, $func);
                }
            } else {
                $this->setMensaje_operacion($base->getError());
            }
        } else {
            $this->setMensaje_operacion($base->getError());
        }
        return $arregloFuncion;
    }

    /* >>> INSERTAR <<< */
    public function insertar($idTeatro)
    {
        $base = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO funcion(id, nombreFuncion, horaInicio, duracion, precioFuncion, mes, tipo, id_teatro)
				VALUES (" . $this->getId() . ",'" . $this->getNombreFuncion() . "'," . $this->getHoraInicio() . "," . $this->getDuracion() . "," . $this->getPrecioFuncion() . "," . $this->getMes() . ",'" . $this->getTipo() . "'," . $idTeatro . ")";

        if ($base->Iniciar()) {

            if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->setId($id);
                $resp = true;
            } else {
                $this->setMensaje_operacion($base->getError());
            }
        } else {
            $this->setMensaje_operacion($base->getError());
        }
        return $resp;
    }

    /* >>> MODIFICAR <<< */
    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $consultaModifica = "UPDATE funcion SET nombreFuncion='" . $this->getNombreFuncion() . "',horaInicio='" . $this->getHoraInicio() . "',duracion='" . $this->getDuracion() . "',precioFuncion='" . $this->getPrecioFuncion() . "',mes='" . $this->getMes() . "',tipo='" . $this->getTipo() . "',id_teatro='" . $this->getId_teatro() . "' WHERE id='" . $this->getId() . "'";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModifica)) {
                $resp = true;
            } else {
                $this->setMensaje_operacion($base->getError());
            }
        } else {
            $this->setMensaje_operacion($base->getError());
        }
        return $resp;
    }

    /* >>> ELIMINAR <<< */
    public function eliminar()
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM funcion WHERE id=" . $this->getId();
            if ($base->Ejecutar($consultaBorra)) {
                $resp = true;
            } else {
                $this->setMensaje_operacion($base->getError());
            }
        } else {
            $this->setMensaje_operacion($base->getError());
        }
        return $resp;
    }

}
