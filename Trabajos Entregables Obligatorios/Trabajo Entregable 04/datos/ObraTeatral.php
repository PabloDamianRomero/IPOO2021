<?php
/**
 * PABLO DAMIAN ROMERO - FAI 1652
 */
class ObraTeatral extends Funcion
{
    /**
     * Declaración de variables
     */
    private $autor;

    /**
     * Método constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->autor = "";
    }

    // /* >>> CARGAR <<< */
    // public function cargar($pId, $pNombre, $pInicio, $pDuracion, $pPrecio, $pMes, $pTipo, $pIdTeatro, $pAutor)
    // {
    //     parent::cargar($pId, $pNombre, $pInicio, $pDuracion, $pPrecio, $pMes, $pTipo, $pIdTeatro);
    //     $this->setAutor($pAutor);
    // }

    /* >>> CARGAR <<< */
    public function cargar($datos)
    {
        parent::cargar($datos);
        $this->setAutor($datos["autor"]);
    }

    /**
     * Obtiene el valor de autor
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Modifica el valor de autor
     */
    public function setAutor($pAutor)
    {
        $this->autor = $pAutor;
    }

    /**
     * Devuelve los datos de la clase
     */
    public function __toString()
    {
        $cadena = "";
        $cadena .= parent::__toString();
        $cadena .= "\n\t * Autor: " . $this->getAutor();
        return $cadena;
    }

    /**
     * Devuelve el precio de la función con calculo de incremento
     */
    public function recibirCosto()
    {
        $costo = parent::recibirCosto() * 0.45;
        return $costo;
    }

    /* >>> BUSCAR <<< */
    /**
     * Recupera los datos de un obraTeatral por id
     *
     * @return true en caso de encontrar los datos, false en caso contrario
     */
    public function Buscar($id)
    {
        $base = new BaseDatos();
        $consulta = "Select * from obrateatral where id=" . $id;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    parent::Buscar($id);
                    $this->setAutor($row2['autor']);
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
        $consulta = "SELECT * FROM obrateatral INNER JOIN funcion ON obrateatral.id = funcion.id";
        if ($condicion != "") {
            $consulta = $consulta . ' where funcion. ' . $condicion;
        }
        $consulta .= " order by autor ";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arreglo = array();
                while ($row2 = $base->Registro()) {
                    $obj = new ObraTeatral();
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
            $consultaInsertar = "INSERT INTO obrateatral(id, autor)
				VALUES (" . parent::getId() . ",'" . $this->getAutor() . "')";
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
            $consultaModifica = "UPDATE obrateatral SET autor='" . $this->getAutor() . "' WHERE id=" . parent::getId();
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
            $consultaBorra = "DELETE FROM obrateatral WHERE id=" . parent::getId();
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

} // Fin de clase
