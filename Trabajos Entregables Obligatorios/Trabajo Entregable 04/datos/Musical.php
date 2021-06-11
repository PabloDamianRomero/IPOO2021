<?php
/**
 * PABLO DAMIAN ROMERO - FAI 1652
 */
class Musical extends Funcion
{
    /**
     * Declaración de variables
     */
    private $director;
    private $cantPersonasEscena;

    /**
     * Método constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->director = "";
        $this->cantPersonasEscena = "";
    }

    // /* >>> CARGAR <<< */
    // public function cargar($pId, $pNombre, $pInicio, $pDuracion, $pPrecio, $pMes, $pTipo, $pIdTeatro, $pDirector, $pCant)
    // {
    //     parent::cargar($pId, $pNombre, $pInicio, $pDuracion, $pPrecio, $pMes, $pTipo, $pIdTeatro);
    //     $this->setDirector($pDirector);
    //     $this->setCantPersonasEscena($pCant);
    // }

    /* >>> CARGAR <<< */
    public function cargar($datos)
    {
        parent::cargar($datos);
        $this->setDirector($datos["director"]);
        $this->setCantPersonasEscena($datos["personas"]);
    }

    /**
     * Obtiene el valor de director
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Obtiene el valor de cantPersonasEscena
     */
    public function getCantPersonasEscena()
    {
        return $this->cantPersonasEscena;
    }

    /**
     * Modifica el valor de director
     */
    public function setDirector($pDirector)
    {
        $this->director = $pDirector;
    }

    /**
     * Modifica el valor de cantPersonasEscena
     */
    public function setCantPersonasEscena($pCant)
    {
        $this->cantPersonasEscena = $pCant;
    }

    /**
     * Devuelve los datos de la clase
     */
    public function __toString()
    {
        $cadena = "";
        $cadena .= parent::__toString();
        $cadena .= "\n\t * Director: " . $this->getDirector();
        $cadena .= "\n\t * Personas en escena: " . $this->getCantPersonasEscena();
        return $cadena;
    }

    /**
     * Devuelve el precio de la función con calculo de incremento
     */
    public function recibirCosto()
    {
        $costo = parent::recibirCosto() * 0.12;
        return $costo;
    }

    /* >>> BUSCAR <<< */
    /**
     * Recupera los datos de un musical por id
     *
     * @return true en caso de encontrar los datos, false en caso contrario
     */
    public function Buscar($id)
    {
        $base = new BaseDatos();
        $consulta = "Select * from musical where id=" . $id;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    parent::Buscar($id);
                    $this->setDirector($row2['director']);
                    $this->setCantPersonasEscena($row2['cantPersonasEscena']);
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
        $consulta = "SELECT * FROM musical INNER JOIN funcion ON musical.id = funcion.id";
        if ($condicion != "") {
            $consulta = $consulta . ' where funcion. ' . $condicion;
        }
        $consulta .= " order by director ";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arreglo = array();
                while ($row2 = $base->Registro()) {
                    $obj = new Musical();
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
            $consultaInsertar = "INSERT INTO musical(id, director, cantPersonasEscena)
				VALUES (" . parent::getId() . ",'" . $this->getDirector() . "'," . $this->getCantPersonasEscena() . ")";
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
            $consultaModifica = "UPDATE musical SET director='" . $this->getDirector() . "',cantPersonasEscena=" . $this->getCantPersonasEscena() . " WHERE id=" . parent::getId();
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
            $consultaBorra = "DELETE FROM musical WHERE id=" . parent::getId();
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
