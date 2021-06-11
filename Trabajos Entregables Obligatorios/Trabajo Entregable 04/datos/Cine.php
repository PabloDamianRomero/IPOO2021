<?php
/**
 * PABLO DAMIAN ROMERO - FAI 1652
 */
class Cine extends Funcion
{
    /**
     * Declaración de variables
     */
    private $genero;
    private $paisOrigen;

    /**
     * Método constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->genero = "";
        $this->paisOrigen = "";
    }

    // /* >>> CARGAR <<< */
    // public function cargar($pId, $pNombre, $pInicio, $pDuracion, $pPrecio, $pMes, $pTipo, $pIdTeatro, $pGenero, $pOrigen)
    // {
    //     parent::cargar($pId, $pNombre, $pInicio, $pDuracion, $pPrecio, $pMes, $pTipo, $pIdTeatro);
    //     $this->setGenero($pGenero);
    //     $this->setOrigen($pOrigen);
    // }

    /* >>> CARGAR <<< */
    public function cargar($datos)
    {
        parent::cargar($datos);
        $this->setGenero($datos["genero"]);
        $this->setPaisOrigen($datos["pais"]);
    }

    /**
     * Obtiene el valor de genero
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Obtiene el valor de paisOrigen
     */
    public function getPaisOrigen()
    {
        return $this->paisOrigen;
    }

    /**
     * Modifica el valor de genero
     */
    public function setGenero($pGenero)
    {
        $this->genero = $pGenero;
    }

    /**
     * Modifica el valor de paisOrigen
     */
    public function setPaisOrigen($pOrigen)
    {
        $this->paisOrigen = $pOrigen;
    }

    /**
     * Devuelve los datos de la clase
     */
    public function __toString()
    {
        $cadena = "";
        $cadena .= parent::__toString();
        $cadena .= "\n\t * Género: " . $this->getGenero();
        $cadena .= "\n\t * País de origen: " . $this->getPaisOrigen();
        return $cadena;
    }

    /**
     * Devuelve el precio de la función con calculo de incremento
     */
    public function recibirCosto()
    {
        $costo = parent::recibirCosto() * 0.65;
        return $costo;
    }

    /* >>> BUSCAR <<< */
    /**
     * Recupera los datos de un cine por id
     *
     * @return true en caso de encontrar los datos, false en caso contrario
     */
    public function Buscar($id)
    {
        $base = new BaseDatos();
        $consulta = "Select * from cine where id=" . $id;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    parent::Buscar($id);
                    $this->setGenero($row2['genero']);
                    $this->setPaisOrigen($row2['paisOrigen']);
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
        $arreglo = null;
        $base = new BaseDatos();
        $consulta = "SELECT * FROM cine INNER JOIN funcion ON cine.id = funcion.id";
        if ($condicion != "") {
            $consulta = $consulta . ' where funcion. ' . $condicion;
        }
        $consulta .= " order by genero ";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arreglo = array();
                while ($row2 = $base->Registro()) {
                    $obj = new Cine();
                    $obj->Buscar($row2['id']);
                    array_push($arreglo, $obj);
                }
            } else {
                $this->setMensaje_operacion($base->getError());
            }
        } else {
            $this->setMensaje_operacion($base->getError());
        }
        return $arreglo;
    }

    /* >>> INSERTAR <<< */
    public function insertar($idTeatro)
    {
        $base = new BaseDatos();
        $resp = false;

        if (parent::insertar($idTeatro)) {
            $consultaInsertar = "INSERT INTO cine(id, genero, paisOrigen)
				VALUES (" . parent::getId() . ",'" . $this->getGenero() . "','" . $this->getPaisOrigen() . "')";
            if ($base->Iniciar()) {
                if ($base->Ejecutar($consultaInsertar)) {
                    $resp = true;
                } else {
                    $this->setMensaje_operacion($base->getError());
                }
            } else {
                $this->setMensaje_operacion($base->getError());
            }
        }
        return $resp;
    }

    /* >>> MODIFICAR <<< */
    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        if (parent::modificar()) {
            $consultaModifica = "UPDATE cine SET genero='" . $this->getGenero() . "',paisOrigen='" . $this->getPaisOrigen() . "' WHERE id=" . parent::getId();
            if ($base->Iniciar()) {
                if ($base->Ejecutar($consultaModifica)) {
                    $resp = true;
                } else {
                    $this->setMensaje_operacion($base->getError());
                }
            } else {
                $this->setMensaje_operacion($base->getError());
            }
        }

        return $resp;
    }

    /* >>> ELIMINAR <<< */
    public function eliminar()
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM cine WHERE id=" . parent::getId();
            if ($base->Ejecutar($consultaBorra)) {
                if (parent::eliminar()) {
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
} //Fin de clase
